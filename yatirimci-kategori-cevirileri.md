# Mistral GYO - Yatırımcı İlişkileri Kategori Çevirileri

## Tarih: 2026-06-29

## Yapılan Güncellemeler

### Yatırımcı İlişkileri Kategoriler (EN) - Düzeltilen Çeviriler

| ID | Eski (Türkçe) | Yeni (İngilizce) |
|----|----------------|-------------------|
| 28 | Genel Kurullar | General Assemblies |
| 29 | Komiteler | Committees |
| 30 | Kar Dagitim Politikasi | Profit Distribution Policy |
| 31 | Ucretlendirme Politikasi | Remuneration Policy |
| 32 | Ticari Sicil Gazetesi | Trade Registry Gazette |
| 33 | Bilgi Toplum Hizmetleri | Public Disclosure Services |
| 34 | ortaklik Yapisi | Shareholder Structure |
| 35 | Kurumsal Yonetim | Corporate Governance |
| 36 | YK ve Ust Yonetim | BOD and Senior Management |
| 37 | Mistral GYO Cerez Politikasi | Cookie Policy |
| 38 | Ozel Durum Aciklamalari | Special Case Disclosures |
| 39 | Imza Sirkuleri | Signature Circulars |

## Notlar

- Sıra numaraları da düzeltildi (id=31 ve id=38)
- İçerik kayıtları (yatirimci_iliskileri) finansal raporlar olduğundan otomatik çeviri yapılmadı
- Gerekirse manuel olarak admin panelden düzenlenebilir

## Veritabanı

```sql
UPDATE yatirimci_iliski_kategori SET baslik='...' WHERE id=... AND dil='en';
```