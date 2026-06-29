# -*- coding: utf-8 -*-
import mysql.connector

conn = mysql.connector.connect(
    host="localhost",
    user="mistralgyocom_user",
    password="2Gr5_8RTuq",
    database="mistralgyocom_yeni_db"
)
cursor = conn.cursor()

# TR: Misyon Vizyon (id=15)
misyon_vizyon_tr = """<p><strong>VIZYON</strong></p>
<p>Kaliteyi yuksek estetik ve cevre bilinciyle bulusturacak projelerle katma deger saglayan ulkenin oncu gayrimenkul yatirim ortakliklarindan biri olmak.</p>
<p><strong>MISYON</strong></p>
<p>Cevreye duyarli, ulkeye ve paydaslara deger katacak projelerle portfoyunu surekli gelistirmek.</p>"""

cursor.execute("UPDATE icerikler SET baslik=%s, icerik=%s WHERE id=%s AND dil=%s",
               ("Misyon and Vizyon", misyon_vizyon_tr, 15, "tr"))

conn.commit()
print(f"Guncellendi: {cursor.rowcount} satir")
cursor.close()
conn.close()
