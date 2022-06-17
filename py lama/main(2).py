import requests
import pandas as pd
from bs4 import BeautifulSoup
import datetime
from datetime import datetime
import MySQLdb
from dateutil import parser


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
            url = f"{self.base_url}topik/rilis-media/page/{page}"

            page = requests.get(url)
            soup = BeautifulSoup(page.text, "html.parser")

            articles = soup.find_all("article")

            for article in articles:
                title = article.find("h3", {"class": "jeg_post_title"}).get_text()
                image = article.find("img")["src"]
                href = article.find("a")["href"]
                url2 = href
                page2 = requests.get(url2)
                soup2 = BeautifulSoup(page2.text, "html.parser")
                content = soup2.find_all('p')
                content = ' '.join(map(str, content))
                published_time = soup2.find("div", {"class": "jeg_meta_date"}).get_text()
                # image = soup2.find("img", {"class": "wp-post-image"})["src"]
                # warning = article.find("div", class_="wp-post-image")
                # image_container = warning.nextSibling.nextSibling
                # image = warning.find("img")["src"]
                
                article_lists.append({
                    "title": title,
                    "published_time": published_time,
                    # "body": body,
                    "content": content,
                    "image": image,
                    "href": href})
                db = MySQLdb.connect(HOST, USERNAME, PASSWORD, DATABASE)
                # tb_berita = []
                # prepare a cursor object using cursor() method
                cursor = db.cursor()
                # tb_berita = []

                # Prepare SQL query to INSERT a record into the database.
                id_admin = 1
                id_kategori = 1
                id_status = 1
                # for published_time_WIB in published_time:
                        # published_time_WIB = published_time[8:18]
                # for published_time_indo in published_time_WIB:
                        # published_time_indo = published_time_WIB.replace("Januari", "Jan").replace("Februari", "Feb").replace("Maret", "Mar").replace("April", "Apr").replace("Mei", "Mei").replace("Juni", "Jun").replace("Juli", "Jul").replace("Agustus", "Agu").replace("September", "Sep").replace("Oktober", "Okt").replace("November", "Nov").replace("Desember", "Des")
                sql = "insert into tb_berita (id_admin, id_kategori, id_status,judul, tgl_berita, isi, gambar, sumber) values (%s,%s,%s,%s,%s,%s,%s,%s)"
                cursor.execute(
                    sql, (id_admin, id_kategori, id_status, title, published_time, content, image, href))
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
            # print(published_time)
            # print(published_time_indo)
            print(f"[~] Total Articles: {len(self.articles)}")

        return self.articles

    def show_results(self, row=5):
        df = pd.DataFrame(self.articles)
        df.index += 1
        if row:
            print(df.head())
        else:
            print(df)

if __name__ == '__main__':
    keywords = input("[~] Keywords     : ")
    pages = input("[~] Total Pages  : ")
    base_url = f"https://sehatnegeriku.kemkes.go.id/"

    scrape = Scraper(keywords, pages)
    response = scrape.fetch(base_url)
    articles = scrape.get_articles(response)

    print("[~] Program Finished")
