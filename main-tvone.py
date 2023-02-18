#! C:/Users/user/AppData/Local/Programs/Python/Python39/python.exe
import cgi
import codecs
import requests
import pandas as pd
from bs4 import BeautifulSoup
from datetime import datetime
from datetime import datetime
import joblib
import MySQLdb
from dateutil import parser

print('Content-Type: text/html')
print()

# membuat atau membuka file html
f = open('GFG.html', 'w')

# html tamplate yang diisikan
html_template = """
    <html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="skydash/vendors/feather/feather.css">
    <link rel="stylesheet" href="skydash/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="skydash/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="skydash/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="skydash/css/vertical-layout-light/style.css">

    </head>
    <style>
        body {
            background-color: #F3F5FE;
            margin: 0 auto;
        }
        .main-panel {
            margin: 0 auto;
        }
        .content-wrapper {
            background-color: #F3F5FE;
            border-radius: 25px;
            padding-top: 20%;
        }
        .card {
            background-color: #ffffff;
            margin: 0 auto;
            border: 2px solid #ffffff;
        }
        p {
            font-size: 18px;
        }
    </style>

    <body>
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-15" href="#"><img src="assets/image/logo1.png" style="min-width:130px; min-height:110px;" class="mr-2" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            </div>
        </nav>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="container-fluid">
                        <div class="alert alert-success" role="alert">
                            <h3>Berhasil Mengaktifkan Filtering Berita !!!</h3>
                        </div>
                    </div>
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p>Sistem filtering telah berhasil di aktifkan dengan melalui proses srapping, filtering data, dan masuk ke database. Silahkan klik tombol kembali untuk kembali ke halaman sebelumnya dan klik menu validasi untuk memvalidasi berita yang sudah berhasil difiltering.</p>
                                <a href="systemfiltering" class="btn btn-outline-info btn-fw float-right">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
    </body>
    </html>
"""

# menulis template html ke dalam file
f.write(html_template)

# menutup file
f.close()

# membaca file html
file = codecs.open("GFG.html", 'r', "utf-8")

# mencetak file html
print(file.read())

HOST = "localhost"
USERNAME = "root"
PASSWORD = ""
DATABASE = "db_filteringhoax"

class Scraper:
    def __init__(self, keywords):
        self.keywords = keywords

    def fetch(self, base_url):
        self.base_url = base_url

        self.params = {
            'q': self.keywords,
        }

        self.headers = {
            'sec-ch-ua': '"(Not(A:Brand";v="8", "Chromium";v="99", "Google Chrome";v="99"',
            'sec-ch-ua-platform': "Linux",
            'sec-fetch-site': 'same-origin',
            'user-agent': 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.35 Safari/537.36'
        }

        self.response = requests.get(
            self.base_url, params=self.params, headers=self.headers)

        return self.response

    def get_articles(self, response):
        article_lists = []
        content_lists = []
        url = f"{self.base_url}?q={self.keywords}"
        page = requests.get(url)
        soup = BeautifulSoup(page.text, "html.parser")
        container = soup.find('div', {"class": "article-list-container"})
        articles = container.find_all(
            'div', {"class": "article-list-row"})
        for article in articles:
            list_info = article.find(
                'div', class_="article-list-info content_center")
            title = list_info.find('h2').get_text()
            href = list_info.find('a')["href"]
            published_time = list_info.find('li', class_="ali-date").get_text()
            url1 = href
            page1 = requests.get(url1)
            soup2 = BeautifulSoup(page1.text, "html.parser")
            page2 = requests.get(url1 + "?page=2")
            soup3 = BeautifulSoup(page2.text, "html.parser")
            wrappImage = soup2.find(
                'div', {"class": "site-container site-container-2column"})
            image = wrappImage.find('img')["src"]
            content = soup2.find_all('p')
            content = ''.join(map(str, content))
            content2 = soup3.find_all('p')
            content2 = ''.join(map(str, content2))

            article_lists.append({
                "title": title,
                "href": href,
                "published_item": published_time,
                "image": image,
                "contenta": content + content2
            })
            db = MySQLdb.connect(HOST, USERNAME, PASSWORD, DATABASE)
            
            # prepare a cursor object using cursor() method
            cursor = db.cursor()
            
            # Model Filtering Hoax
            berita = title + content + content2
            # load from file and predict using the best configs found in the CV step
            model_FilteringHoax = joblib.load("model_NB.pkl")
            beritap_preds = model_FilteringHoax.predict([berita])

            if beritap_preds == 0:
                kategori = 2
            else:
                kategori = 1

            # Prepare SQL query to INSERT a record into the database.
            id_admin = 1
            id_status = 1
            
            for published_time_indo in published_time:
                    published_time_indo = published_time.replace("/01/", " Jan ").replace("/02/", " Feb ").replace("/03/", " Mar ").replace("/04/", " Apr ").replace("/05/", " Mei ").replace("/06/", " Jun ").replace("/07/", " Jul ").replace("/08/", " Agu ").replace("/09/", " Sep ").replace("/10/", " Okt ").replace("/11/", " Nov ").replace("/12/", " Des ")
            for published_time_WIB in published_time_indo:
                    published_time_WIB = published_time_indo[0:12]
            sql = "insert into tb_berita (id_admin, id_kategori, id_status,judul, tgl_berita, isi, gambar, sumber) values (%s,%s,%s,%s,%s,%s,%s,%s)"
            cursor.execute(
                sql, (id_admin, kategori, id_status, title, published_time_WIB, content + content2 , image, href))

            db.commit()
            db.close()

form = cgi.FieldStorage()
if __name__ == '__main__':
    keywords = form.getvalue('kata_kunci_tvone')
    base_url = f"https://www.tvonenews.com/cari"

    scrape =Scraper(keywords)
    response = scrape.fetch(base_url)
    articles = scrape.get_articles(response)
    
    print(keywords)
