# 🏋️‍♂️ Supplement Satış Platformu

Bu proje, kullanıcıların çeşitli supplement ürünlerini satın alabilecekleri bir e-ticaret platformudur. Enerji kaynakları, protein tozları, L-Carnitine ve daha birçok supplementin satışını yapmaktadır. Javascript, PHP, MySQL, HTML, CSS ve Bootstrap kullanılarak geliştirilmiştir. Admin paneli sayesinde ürünleri ekleyebilir, silebilir ve güncelleyebilirsiniz.

## 🚀 Özellikler
- 🔹 Kullanıcı girişi ve kayıt sistemi
- 🔹 Supplement ekleme, düzenleme ve silme (Admin Paneli)
- 🔹 Ürün detayları ve açıklamaları
- 🔹 Sepete ekleme ve satın alma işlemleri
- 🔹 Kullanıcı dostu arayüz
- 🔹 Mobile uyumlu

## 🛠️ Kullanılan Teknolojiler
- **Frontend:** HTML, CSS, Bootstrap, Javascript
- **Backend:** PHP
- **Veritabanı:** MySQL (phpMyAdmin üzerinden yönetilmektedir)
- **Server:** WampServer

## 📦 Kurulum
1. **WampServer'ı indirip** kurun: [WampServer](https://www.wampserver.com/)
2. **Proje dosyalarını** `C:/wamp64/www/` içine kopyalayın.
3. **Veritabanı Bağlantısı:**
Veritabanı Kurulumu
Projeye ait veritabanını kurmak için primefit.sql dosyasını kullanabilirsiniz. Bu SQL dosyası, veritabanını başlatmak için gerekli şemayı ve veriyi içermektedir.

Talimatlar:
primefit.sql dosyasını indirin ve veritabanı yönetim sisteminize (MySQL, PostgreSQL vb.) içe aktarın.

SQL dosyasını çalıştırın:

MySQL kullanıyorsanız, şu komutu MySQL terminal veya GUI aracılığıyla çalıştırabilirsiniz:
sql
Kopyala
Düzenle
SOURCE path/to/primefit.sql;
Veritabanı, proje için gerekli olan tablolar ve veriler ile oluşturulacaktır.

Dosyayı içe aktarmadan önce doğru izinlere sahip olduğunuzdan ve veritabanı ortamınızın düzgün çalıştığından emin olun.

   - `ilgili PHP dosyanızda aşağıdaki kodu kullanarak veritabanına bağlanın:
     ```php
     <?php
     // Veritabanı bağlantısı
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "primefit";
     ?>
     ```
     ve wampserverde phpmyadmin bölümünde primefit diye bir database oluşturup ilgili tabloları oluşturun.
5. **Projeyi çalıştırın:**
   - Tarayıcınıza `http://localhost/primefit` yazın.

## 📸 Ekran Görüntüleri

**Ansayfadan bir görüntü**
![1](https://github.com/user-attachments/assets/5582cb2a-b361-4225-bbd3-09f7151c05d9)

**Ansayfadan bir görüntü**
![2](https://github.com/user-attachments/assets/467d3332-35d0-49d1-904e-7fbbc8be0ecb)

**Kategorilerden bir görüntü**
![3](https://github.com/user-attachments/assets/d40b4311-b07d-4b0f-9aca-b76dd976814d)

**Herhangi bir üründen bir görüntü**
![4](https://github.com/user-attachments/assets/51b805c9-16c7-42af-a21b-87e08b5539bc)

**Admin panelinden bir görüntü**
![5](https://github.com/user-attachments/assets/f54aa316-8b8f-49e8-9e58-e2129c160d4b)

**Ürün yönetiminden bir görüntü**
![6](https://github.com/user-attachments/assets/3f9587ad-0180-442d-9a35-e0685501f162)


## 🛒 Kullanım
- Kullanıcılar **kayıt olup giriş yaparak** ürünleri inceleyebilir ve satın alabilir.
- Ürünler sepete eklenip **ödeme işlemi tamamlanabilir**.
- Admin paneli üzerinden **ürün yönetimi yapılabilir**.
