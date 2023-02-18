import pandas as pd
import datetime
from datetime import datetime
import joblib

# Mengambil inputan
print('-------------------- Filtering Hoax --------------------')
judul = input('Masukkan Judul Berita : ')
isi = input('Masukkan Isi Berita : ')

# Filtering Hoax
berita = judul + isi

# load from file and predict using the best configs found in the CV step
model_FilteringHoax = joblib.load("model_NB.pkl" )
# run predictions on twitter data
beritap_preds = model_FilteringHoax.predict([berita])

if beritap_preds == 0:
    kategori = 2
else :
    kategori = 1
    

print('------------------- Hasil Filtering -------------------')
print('Judul Berita : \n', judul)
print('Isi Berita : \n', isi)
print('Hasil Pengkategorian Berita : ')
if kategori == 1:
    print(kategori, 'Kategori Berita Fakta')
else :
    print(kategori, 'Kategori Berita Hoax')