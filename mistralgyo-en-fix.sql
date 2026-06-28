-- MISTRAL GYO ENGLISH CONTENT FIX SCRIPT
-- Run this on: mistralgyocom_yeni_db

-- ============================================
-- 1. MENULER (3 items to fix)
-- ============================================
UPDATE menuler SET baslik='About REIC' WHERE id=68 AND dil='en';
UPDATE menuler SET baslik='Mistral GYO Personal Data Form' WHERE id=72 AND dil='en';
UPDATE menuler SET baslik='Mistral GYO Organization Chart' WHERE id=76 AND dil='en';

-- ============================================
-- 2. HABERLER (20 items - translate titles)
-- ============================================
UPDATE haberler SET baslik='News Turk Egeli' WHERE id=31 AND dil='en';
UPDATE haberler SET baslik='News Turk Egeli - Mistral Izmir Groundbreaking Ceremony' WHERE id=32 AND dil='en';
UPDATE haberler SET baslik='Hurriyet Ege - Mistral Izmir Groundbreaking Ceremony' WHERE id=33 AND dil='en';
UPDATE haberler SET baslik='www.hurriyetemlak.com - Mistral Izmir square meter starts at 3 thousand dollars' WHERE id=34 AND dil='en';
UPDATE haberler SET baslik='www.htemlak.com - Mistral Towers unveiled today! Square meter 3 thousand dollars!' WHERE id=35 AND dil='en';
UPDATE haberler SET baslik='www.dunya.com - Mistral Yapi invites the business world to Izmir' WHERE id=36 AND dil='en';
UPDATE haberler SET baslik='www.emlak.sabah.com.tr - 150 million dollar project to Izmirs Maslak' WHERE id=37 AND dil='en';
UPDATE haberler SET baslik='www.sozcu.com.tr - Mistral Izmir unveiled' WHERE id=38 AND dil='en';
UPDATE haberler SET baslik='www.emlakkulisi.com - Mistral Izmir project unveiled!' WHERE id=39 AND dil='en';
UPDATE haberler SET baslik='www.emlaktasondakika.com' WHERE id=40 AND dil='en';
UPDATE haberler SET baslik='www.dailymotion.com' WHERE id=41 AND dil='en';
UPDATE haberler SET baslik='www.emlakdream.com - August 5, 2014' WHERE id=42 AND dil='en';
UPDATE haberler SET baslik='www.emlakbulten.com' WHERE id=43 AND dil='en';
UPDATE haberler SET baslik='www.hurriyet.com.tr' WHERE id=44 AND dil='en';
UPDATE haberler SET baslik='www.milliyet.com.tr' WHERE id=45 AND dil='en';
UPDATE haberler SET baslik='www.ekonomi.milliyet.com.tr' WHERE id=46 AND dil='en';
UPDATE haberler SET baslik='www.konuthaberleri.com' WHERE id=47 AND dil='en';
UPDATE haberler SET baslik='www.sondakika.com' WHERE id=48 AND dil='en';
UPDATE haberler SET baslik='www.haberler.com' WHERE id=49 AND dil='en';
UPDATE haberler SET baslik='www.emlakwebtv.com' WHERE id=50 AND dil='en';

-- ============================================
-- 3. SSS - SORULAR VE CEVAPLAR (5 items)
-- ============================================
UPDATE sss SET soru='1. In which areas does Mistral GYO operate?', cevap='<p>Mistral GYO develops real estate projects primarily in residential, office, commercial spaces and mixed-use projects, with a high aesthetic understanding and environmental awareness. The company focuses on projects that improve quality of life and create long-term added value.</p>' WHERE id=11 AND dil='en';

UPDATE sss SET soru='2. What is the material and construction quality like in your projects?', cevap='<p>All Mistral GYO projects use quality-standard compliant, long-lasting and reliable construction materials. Construction processes are meticulously carried out by expert teams and quality controls are regularly performed.</p>' WHERE id=12 AND dil='en';

UPDATE sss SET soru='3. How is environmental sensitivity ensured in Mistral GYO projects?', cevap='<p>Projects are developed in line with energy-efficient solutions, eco-friendly design approaches and sustainable construction principles. The goal is to offer areas that are respectful to nature and enhance quality of life.</p>' WHERE id=13 AND dil='en';

UPDATE sss SET soru='4. How does the process of purchasing a residence or commercial space from Mistral GYO work?', cevap='<p>The purchasing process includes project presentation, identifying suitable options based on needs, and post-sale information steps. Customers receive transparent and one-on-one support from the professional sales team throughout the process.</p>' WHERE id=14 AND dil='en';

UPDATE sss SET soru='5. Why is investing in real estate from Mistral GYO advantageous?', cevap='<p>Mistral GYO projects offer long-term appreciation potential thanks to strong location choices, high architectural standards and professional project management. The companys corporate governance approach provides a reliable and transparent structure for investors.</p>' WHERE id=15 AND dil='en';

-- ============================================
-- 4. PROJELER (4 items)
-- ============================================
UPDATE projeler SET baslik='Mistral Izmir' WHERE id=5 AND dil='en';
UPDATE projeler SET baslik='Kumsal Boyalik' WHERE id=6 AND dil='en';
-- Mia Port (id=7) - keep as is if already English
UPDATE projeler SET baslik='Izmir Province, Konak District, Mersinli Neighborhood, 8623 Plot 21 Parcel' WHERE id=8 AND dil='en';

-- ============================================
-- 5. ICERIKLER (13 items to fix)
-- ============================================
UPDATE icerikler SET baslik='REIC Legislation' WHERE id=33 AND dil='en';
UPDATE icerikler SET baslik='Mistral GYO Privacy Policy' WHERE id=34 AND dil='en';
-- id=35 "deneme icerik" - test content, can delete or leave
UPDATE icerikler SET baslik='Mistral GYO Organization Chart' WHERE id=36 AND dil='en';
UPDATE icerikler SET baslik='Mistral GYO Quality Policy' WHERE id=37 AND dil='en';
UPDATE icerikler SET baslik='Mistral GYO JSC Contact Information' WHERE id=38 AND dil='en';
UPDATE icerikler SET baslik='MISTRAL GYO JSC Quality Documents' WHERE id=39 AND dil='en';
-- id=40 "Ilgili Linkler" is already correct in menus (id=70)
UPDATE icerikler SET baslik='Corporate Governance Manual and Stakeholder Communication Plan' WHERE id=41 AND dil='en';
UPDATE icerikler SET baslik='Information Security Policy' WHERE id=42 AND dil='en';

-- ============================================
-- VERIFICATION QUERIES
-- ============================================
-- SELECT 'MENULER' as tablo, id, baslik FROM menuler WHERE dil='en' ORDER BY id;
-- SELECT 'HABERLER' as tablo, id, baslik FROM haberler WHERE dil='en' ORDER BY id;
-- SELECT 'SSS' as tablo, id, soru FROM sss WHERE dil='en' ORDER BY id;
-- SELECT 'PROJELER' as tablo, id, baslik FROM projeler WHERE dil='en' ORDER BY id;
-- SELECT 'ICERIKLER' as tablo, id, baslik FROM icerikler WHERE dil='en' AND baslik IS NOT NULL ORDER BY id;