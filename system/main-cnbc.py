#! C:/Users/user/AppData/Local/Programs/Python/Python39/python.exe
import cgi
import requests
import pandas as pd
from bs4 import BeautifulSoup
import datetime
from datetime import datetime
import MySQLdb
from dateutil import parser
import joblib

# print('Content-Type: text/html')
# print()
# print("<META HTTP-EQUIY=refresh CONETNT=\"0;URL=http://localhost/filteringhoax/systemfiltering\">\n");
print('<span class="class"><a href="http://localhost/filteringhoax/systemfiltering/index"> Back </a></span>');

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
            url = f"{self.base_url}?query={self.keywords}&p={page}"

            page = requests.get(url)
            soup = BeautifulSoup(page.text, "html.parser")

            articles = soup.find_all("article")

            for article in articles:
                title = article.find("h2").get_text()
                # published_time = article.find(
                image = article.find("img")["src"]
                href = article.find("a")["href"]
                # body = article.find("p").get_text()
                url2 = href
                page2 = requests.get(url2)
                soup2 = BeautifulSoup(page2.text, "html.parser")
                content = soup2.find_all('p')
                content = ' '.join(map(str, content))
                published_time = soup2.find("div", {"class": "date"}).get_text()
                
                article_lists.append({
                    "title": title,
                    "published_time": published_time,
                    # "body": body,
                    "content": content,
                    "image": image,
                    "href": href})
                db = MySQLdb.connect(HOST, USERNAME, PASSWORD, DATABASE)
                # prepare a cursor object using cursor() method
                cursor = db.cursor()
                # tb_berita = []
                
                # Filtering Hoax
                berita = title + content
                
                # load from file and predict using the best configs found in the CV step
                model_FilteringHoax = joblib.load("model_NB.pkl" )
                # run predictions on twitter data
                beritap_preds = model_FilteringHoax.predict([berita])
                
                if beritap_preds == 0:
                    kategori = 2
                else :
                    kategori = 1

                # Prepare SQL query to INSERT a record into the database.
                id_admin = 1
                id_status = 1
                for published_time_indo in published_time:
                        published_time_indo = published_time.replace("Januari", "Jan").replace("January", "Jan").replace("Februari", "Feb").replace("February", "Feb").replace("Maret", "Mar").replace("March", "Mar").replace("April", "Apr").replace("Mei", "Mei").replace("May", "Mei").replace("Juni", "Jun").replace("June", "Jun").replace("Juli", "Jul").replace("July", "Jul").replace("Agustus", "Agu").replace("August", "Agu").replace("September", "Sep").replace("Oktober", "Okt").replace("October", "Okt").replace("November", "Nov").replace("Desember", "Des").replace("December", "Des")
                for published_time_WIB in published_time_indo:
                        published_time_WIB = published_time_indo[0:12]
                sql = "insert into tb_berita (id_admin, id_kategori, id_status,judul, tgl_berita, isi, gambar, sumber) values (%s,%s,%s,%s,%s,%s,%s,%s)"
                cursor.execute(
                    sql, (id_admin, kategori, id_status, title, published_time_WIB, content, image, href))
                print("BERHASIL")

                db.commit()
                db.close()

        self.articles = article_lists
        try:
            self.show_results()
        except Exception as e:
            print(e)
        finally:
            print()
            print("[~] Scraping finished!")
            print(f"[~] Total Articles: {len(self.articles)}")

        return self.articles

    def show_results(self, row=5):
        df = pd.DataFrame(self.articles)
        df.index += 1
        if row:
            print(df.head())
        else:
            print(df)

form = cgi.FieldStorage()
if __name__ == '__main__':
    keywords = form.getvalue('kata_kunci_cnbc')
    pages = form.getvalue('nomor_hal_cnbc')
    base_url = f"https://www.cnbcindonesia.com/search/"

    scrape = Scraper(keywords, pages)
    response = scrape.fetch(base_url)
    articles = scrape.get_articles(response)
    
    print (keywords)

    print("[~] Program Finished")
   