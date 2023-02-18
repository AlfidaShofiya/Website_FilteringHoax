#! C:\Users\User\AppData\Local\Programs\Python\Python39\python.exe
import cgi
import codecs
import requests
import pandas as pd
from bs4 import BeautifulSoup
import datetime
from datetime import datetime
import MySQLdb
from dateutil import parser
import joblib

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
    def __init__(self, keywords, pages):
        self.keywords = keywords
        self.pages = pages

    def fetch(self, base_url):
        self.base_url = base_url

        self.params = {
            'query': self.keywords,
            'sortby': 'time',
            'page': 2
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

        for page in range(1, int(self.pages)+1):
            url = f"{self.base_url}?query={self.keywords}&sortby=time&page={page}"

            page = requests.get(url)
            soup = BeautifulSoup(page.text, "html.parser")

            articles = soup.find_all("article")

            for article in articles:
                title = article.find("h2", {"class": "title"}).get_text()
                published_time = article.find(
                    "span", {"class": "date"}).get_text().split(",")[1]
                image = article.find("img")["src"]
                href = article.find("a")["href"]
                body = article.find("p").get_text()
                url2 = href
                page2 = requests.get(url2)
                soup2 = BeautifulSoup(page2.text, "html.parser")
                content = soup2.find_all('p')
                content = ' '.join(map(str, content))
                
                article_lists.append({
                    "title": title,
                    "published_time": published_time,
                    "body": body,
                    "content": content,
                    "image": image,
                    "href": href})
                db = MySQLdb.connect(HOST, USERNAME, PASSWORD, DATABASE)
                
                # prepare a cursor object using cursor() method
                cursor = db.cursor()
                
                # Model Filtering Hoax
                berita = title + content
                
                # load from file and predict using the best configs found in the CV step
                model_FilteringHoax = joblib.load("model_NB.pkl" )
                beritap_preds = model_FilteringHoax.predict([berita])
                
                if beritap_preds == 0:
                    kategori = 2
                else :
                    kategori = 1

                # Prepare SQL query to INSERT a record into the database.
                id_admin = 1
                id_status = 1
                
                for published_time_WIB in published_time:
                        published_time_WIB = published_time[0:12]
                for published_time_indo in published_time_WIB:
                        published_time_indo = published_time_WIB.replace("Januari", "Jan").replace("Februari", "Feb").replace("Maret", "Mar").replace("April", "Apr").replace("Mei", "Mei").replace("Juni", "Jun").replace("Juli", "Jul").replace("Agustus", "Agu").replace("September", "Sep").replace("Oktober", "Okt").replace("November", "Nov").replace("Desember", "Des")

                sql = "insert into tb_berita (id_admin, id_kategori, id_status,judul, tgl_berita, isi, gambar, sumber) values (%s,%s,%s,%s,%s,%s,%s,%s)"
                cursor.execute(
                    sql, (id_admin, kategori, id_status, title, published_time_indo, content, image, href))

                db.commit()
                db.close()

form = cgi.FieldStorage()
if __name__ == '__main__':
    keywords = form.getvalue('kata_kunci_detik')
    pages = form.getvalue('nomor_hal_detik')
    base_url = f"https://www.detik.com/search/searchall"

    scrape = Scraper(keywords, pages)
    response = scrape.fetch(base_url)
    articles = scrape.get_articles(response)
    print (keywords)
    print("[~] Selesai Difiltering!")


