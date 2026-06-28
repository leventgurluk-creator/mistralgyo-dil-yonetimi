# Mistral GYO - Çoklu Dil Yönetimi Geliştirme Promptu

## Proje Bilgileri

**Site URL:** https://www.mistralgyo.com.tr/demo/en
**Yönetim Paneli:** https://www.mistralgyo.com.tr/demo/yonetim/giris
**Sunucu:** 178.20.231.92:41923 (root)

**Proje Yolu:** `/home/mistralgyocom/`
**Application:** `/home/mistralgyocom/application_demo/`
**Demo Frontend:** `/home/mistralgyocom/public_html/demo/` → CodeIgniter app: `application_demo`
**Vendor/Framework:** `/home/mistralgyocom/vendor/codeigniter/framework/system/`

**Veritabanı:**
- Host: localhost
- User: mistralgyocom_user
- Pass: 2Gr5_8RTuq
- DB: mistralgyocom_yeni_db

---

## Mevcut Durum Analizi

### 1. Dil Sistemi (Çalışıyor)
- `dil()` helper fonksiyonu mevcut → URL'den `tr` veya `en` okuyor
- `/demo/en` ve `/demo/tr` URL yapısı aktif
- `ayarlar` tablosunda hem `tr` hem `en` kayıtları mevcut
- Tüm içerik tablolarında `dil` kolonu var (tr/en ayrımı yapılıyor)

### 2. Yönetim Paneli (Eksik)
- Login: `yonetim/giris`
- `session['_yonetici_dil']` ile admin dil tercihi kaydediliyor ama kullanılmıyor
- İçerik ekleme/düzenleme formlarında sadece **Türkçe alanlar** görünüyor
- Yönetim panelinde dil seçici yok → EN içerikler yönetilemiyor

### 3. Veritabanı Tabloları (Dil Destekli)
Tüm tablolarda `dil` varchar(2) kolonu var:
- `ayarlar` ✅ tr+en kayıtlar mevcut
- `menuler` ✅ 22 tr + 23 en kayıt
- `haberler` ✅ 20 tr + 20 en kayıt
- `sss` ✅ 5 tr + 5 en kayıt
- `projeler`, `icerikler`, `bloklar`, `bannerlar`, `galeri_icerik`, `galeri_kategori`, `iletisim`, `insan_kaynaklari`, `iletisim_formu`, `ebulten`, `popup`, `sosyal_medya`, `yatirimci_iliskileri`, `yatirimci_iliski_kategori`

### 4. Language Dosyaları
- `/application_demo/language/turkish/arcepaket_lang.php` → 70+ çeviri anahtarı
- `/application_demo/language/english/arcepaket_lang.php` → Aynı anahtarlar, EN değerler

---

## Hedef: Yönetim Paneli Dil Yönetimi

### Ana Kural
> Yönetim panelinde TR tarafında ne görünüyorsa, EN tarafında da aynı alanlar yönetilebilir olmalı.

### Yapılması Gerekenler

#### 1. Admin Header'a Dil Seçici Ekle
**Dosya:** `/application_demo/views/yonetim/header.php`

Admin header'ında sağ üst köşeye (kullanıcı menüsünün yanına) dil seçici ekle:
```html
<li class="dropdown dropdown-language">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="<?=base_url('assets/yonetim/flags/'.dil().'.png')?>" alt="">
        <span class="username"><?=dil() == 'tr' ? 'Türkçe' : 'English'?></span>
        <i class="fa fa-angle-down"></i>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="<?=site_url('yonetim/dil_degistir/tr')?>">
                <img src="<?=base_url('assets/yonetim/flags/tr.png')?>"> Türkçe
            </a>
        </li>
        <li>
            <a href="<?=site_url('yonetim/dil_degistir/en')?>">
                <img src="<?=base_url('assets/yonetim/flags/en.png')?>"> English
            </a>
        </li>
    </ul>
</li>
```

#### 2. Dil Değiştirme Controller'ı
**Dosya:** `/application_demo/controllers/yonetim/Genel.php` (veya Anasayfa.php'ye ekle)
```php
public function dil_degistir($dil = 'tr') {
    if (in_array($dil, ['tr', 'en'])) {
        $this->session->set_userdata('_yonetici_dil', $dil);
    }
    redirect('yonetim/anasayfa');
}
```

#### 3. İçerik Ekleme/Düzenleme Formlarında Dil Bazlı Alanlar
**Dosya:** `/application_demo/views/yonetim/icerik/ekle.php` ve `duzenle.php`

Mevcut form yapısı:
- Tek dil desteği, TR içerik giriliyor
- `kolon_baslik` JSON'dan alan adları alınıyor

Yeni yapı:
- Form üstüne "İçerik Dili" dropdown'ı ekle (TR / EN)
- Seçilen dile göre form alanları dinamik gösterilsin
- VEYA: Her içerik alanı için TR+EN versiyonlu iki input

**Önerilen Yaklaşım (Form Alanı Bazlı):**
```php
// Her metin alanı için iki input göster
<div class="form-group">
    <label>Başlık (TR)</label>
    <input type="text" name="baslik_tr" class="form-control" value="<?=$kayit->baslik?>">
</div>
<div class="form-group">
    <label>Başlık (EN)</label>
    <input type="text" name="baslik_en" class="form-control" value="<?=$kayit_en->baslik ?? ''?>">
</div>
```

#### 4. İçerik Modeli Güncellemesi
**Dosya:** `/application_demo/models/yonetim/Icerik_model.php`

`ekle()` ve `guncelle()` metodlarında:
- `dil` parametresi alınacak
- TR ve EN kayıtları ayrı insert/update edilecek

```php
public function ekle($tablo, $data, $dil = 'tr') {
    $data['dil'] = $dil;
    $this->db->insert($tablo, $data);

    // Eğer aynı içerik için EN versiyon da geldiyse
    if (isset($data['_en'])) {
        $enData = $data['_en'];
        $enData['dil'] = 'en';
        $this->db->insert($tablo, $enData);
    }
}
```

#### 5. Menuler Tablosu İçin Özel Dikkat
Menuler tablosunda `dil` + `ust_id` kombinasyonu önemli:
- EN menulerin `ust_id` değerleri EN menuleri göstermeli
- Veya `ust_id` aynı kalsın, dil bazlı filtreleme yapılsın

#### 6. Ayarlar Tablosu Yönetimi
**Dosya:** `/application_demo/controllers/yonetim/Icerik.php`

`ayarlar` tablosu için özel yönetim:
- TR ve EN ayarları ayrı satırlarda
- Form'da iki dil için ayrı field grupları
- Kaydet butonu her iki dili de günceller

---

## Detaylı Form Yapısı Örneği (Haberler için)

**Mevcut (Sadece TR):**
```
Başlık: [___________]
Özet:   [___________]
İçerik: [___________]
```

**Yeni (TR + EN):**
```
═══════════════════════════════════════
İçerik Dili: [TR ▼]
═══════════════════════════════════════

TR Başlık:      [___________]
EN Başlık:      [___________]

TR Özet:        [___________]
EN Özet:        [___________]

TR İçerik:      [___________] (CKEditor)
EN İçerik:      [___________] (CKEditor)

[Kaydet]
```

---

## Öncelik Sırası

1. **Header'a dil seçici ekle** (en hızlı, en görünür)
2. **Genel dil_degistir fonksiyonu** (altyapı)
3. **Haberler formu** → TR+EN alanlı hale getir (pilot)
4. **Diğer içerik türleri** → aynı yapıyı uygula
5. **Menuler** → özel dikkat, ust_id ilişkisi
6. **Ayarlar** → özel yönetim sayfası

---

## Test Senaryoları

1. Admin panelde TR seçiliyken haber ekle → TR kaydı oluşsun
2. Admin panelde EN seçiliyken haber ekle → EN kaydı oluşsun
3. Frontend `/demo/tr/haberler` → TR içerikler görünsün
4. Frontend `/demo/en/news` → EN içerikler görünsün
5. TR ve EN içerikler birbirinden bağımsız düzenlenebilsin

---

## Karşılaşabilecek Sorunlar

1. **Dil seçimi kalıcılığı:** Session'da `_yonetici_dil` kaydedilmeli
2. **İlişkili tablolar:** `ust_id`, `kategori_id` gibi foreign key'ler doğru dile point etmeli
3. **Menu ID'leri:** TR ve EN menulerin ID'leri farklı, bu dikkate alınmalı
4. **URL routing:** `/demo/en` ve `/demo/tr` ön eki doğru çalışmalı

---

## Notlar

- CodeIgniter 3.x kullanılıyor
- MY_Controller base class mevcut
- `crud_model` ve `yonetim` library'leri kullanılıyor
- Asset dosyaları: `/home/mistralgyocom/public_html/assets/`
- Admin assets: `/home/mistralgyocom/public_html/assets/yonetim/`
- Bayrak ikonları için `flags/` klasörü yoksa oluşturulacak