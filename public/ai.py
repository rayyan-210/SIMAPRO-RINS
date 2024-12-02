import mysql.connector

db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="simapro"
)
cursor = db.cursor()
print("Koneksi berhasil!")

import pandas as pd

query = "SELECT * FROM penjualan"
penjualan = pd.read_sql(query, db)
print(penjualan)

penjualan['rekomendasi'] = penjualan.apply(
    lambda row: f"Diskon 20% untuk {row['nama']}" if row['stok'] > 20 else "Pertahankan harga",
    axis=1
)
print(penjualan[['produk', 'rekomendasi']])

