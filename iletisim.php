
<?php
session_start();

$servername = "localhost";
$username = "root"; // Veritabanı kullanıcı adınızı girin
$password = "";         // Veritabanı şifrenizi girin
$dbname = "primefit";        // Veritabanı adınızı girin

// Veritabanı bağlantısını oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Formdan gelen bilgileri alın
    $ad = trim($_POST['ad']);
    $soyad = trim($_POST['soyad']);
    $email = trim($_POST['email']);
    $bizeUlasmaSebebi = trim($_POST['bize_ulasma_sebebi']);

    // Basit bir doğrulama
    if (empty($ad) || empty($soyad) || empty($email) || empty($bizeUlasmaSebebi)) {
        $error_message = "Lütfen tüm alanları doldurun.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Geçersiz e-posta adresi.";
    } else {
        // Veritabanına bağlan ve verileri ekle
        $query = "INSERT INTO iletisimbilgileri (Ad, Soyad, EmailAdress, bizeUlasmaSebebiniz) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssss', $ad, $soyad, $email, $bizeUlasmaSebebi);

        if ($stmt->execute()) {
            $success_message = "Bilgileriniz başarıyla gönderildi!";
        } else {
            $error_message = "Bir hata oluştu. Lütfen tekrar deneyin.";
        }

        $stmt->close();
    }
}

// Veritabanı bağlantısını kapat
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Düzenleme</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styleiletisim.css">
    <title>PRIME FIT</title>
</head>

<body>
    <section class="ustMenu">
        <div class="navbarMenu">
            <!-- Logo ve Başlık -->
            <div class="siteLogoVeBaslik">
                <div class="siteLogo">
                    <a class="logoa" href="index.php"><img src="images/myLogo.png" alt="Logo" width="200px"></a>
                </div>
            </div>
            <!-- Arama ve Menü -->
            <div class="aramaVeIcerik">
                <div class="icerik">
                    <ul class="kategoriler">
                        <li><a href="index.php">Anasayfa</a></li>
                        <li class="kategoriGosterimi">
                            <a class="kategoris" href="#">Ürünlerimiz</a>
                            <ul class="altKategoriler">
                                <li><a href="proteintozu.php"> PROTEİN TOZU</a></li>
                                <li><a href="aminoasit.php"> AMİNO ASİT</a></li>
                                <li><a href="karbonhidrat.php"> KARBONHİDRAT</a></li>
                                <li><a href="l-carnitine.php"> L-CARNITINE</a></li>
                                <li><a href="enerjikaynaklari.php"> ENERJİ KAYNAKLARI</a></li>
                            </ul>
                        </li>
                        <li><a href="hakkinda.php">Hakkımızda</a></li>
                        <li><a href="iletisim.php">İletişim</a></li>
                    </ul>
                </div>
            </div>

            <!-- Giriş ve Sepet -->
            <div class="girisVeSepet">
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="kart">
                    <a href="profilim.php">👤 Profilim</a>
                </div>
                <div class="kart">
                    <a href="cikis.php">Çıkış Yap</a>
                </div>
            <?php else: ?>
                <div class="kart">
                    <a href="girisyap.php">👤 Giriş Yap/Kayıt Ol</a>
                </div>
            <?php endif; ?>
            <div class="profil">
                <a href="urunler/sepet.php">🛒 Sepet</a>
            </div>
        </div>
        </div>
        <div class="info-bar">
            <div class="info-item">
                <img src="images/protect.png" alt="Güvenli Alışveriş" width="24" height="24">
                <span>- Tüm Bilgileriniz Güvende</span>
            </div>
            <div class="info-item">
                <img src="images/shipping.png" alt="Aynı Gün Kargo" width="24" height="24">
                <span>- Aynı Gün Kargoda</span>
            </div>
            <div class="info-item">
                <img src="images/return.png" alt="Ücretsiz İade" width="24" height="24">
                <span>- 14 Gün İçinde Koşulsuz İade</span>
            </div>
            <div class="info-item">
                <img src="images/support.png" alt="Müşteri Desteği" width="24" height="24">
                <span>- İhtiyacınız Olan Her An</span>
            </div>
        </div>

    </section>
    <section class="iletisimMenu">
        <div class="iletisimKismi">
            <h2 class="iletisimBaslik">İLETİŞİM</h2>
            <?php if (!empty($success_message)): ?>
                <div class="alert alert-success"><?= $success_message; ?></div>
            <?php elseif (!empty($error_message)): ?>
                <div class="alert alert-danger"><?= $error_message; ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="row iletisimElemani">
                    <div class="col-sm mb-2">
                        <label for="ad" style="margin-left: 5px;">Ad</label>
                        <input type="text" name="ad" class="form-control" placeholder="İsim" required>
                    </div>
                    <div class="col-sm">
                        <label for="soyad" style="margin-left: 5px;">Soyad</label>
                        <input type="text" name="soyad" class="form-control" placeholder="Soyisim" required>
                    </div>
                </div>
                <div class="row iletisimElemani">
                    <div class="col-sm mb-2">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="ornek@eposta.com" required>
                    </div>
                </div>
                <div class="row iletisimElemani">
                    <div class="col-sm mb-2">
                        <label for="bize_ulasma_sebebi">Bize ulaşma sebebiniz</label>
                        <textarea name="bize_ulasma_sebebi" class="form-control" id="bize_ulasma_sebebi" rows="10" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col iletisimbtnDiv">
                        <button type="submit" class="btn btn-secondary btn-lg iletisimBtn">Gönder</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="footerMenu">
        <div class="footer">
            <div class="siteLogoVeBaslik" id="footerLogoVeBaslik">
                <div class="siteLogo">
                    <a class="logoa" href="index.php"><img src="images/myLogo.png" alt="Logo" width="200px"></a>
                </div>
            </div>
            <p class="footer-text">© 2024 Tüm Hakları Saklıdır.</p>
            <div class="sosyalMedya">
                <a href="#"><img src="images/ig-logo.png" width="45px" height="45px" alt="İnstagram"></a>
                <a href="#"><img src="images/fb-logo.png" width="45px" height="45px" alt="Facebook"></a>
                <a href="#"><img src="images/x-logo.png" width="40px" height="40px" alt="X"></a>
            </div>
            <a href="admin_login.php" style="text-decoration: none; color: gray;"><span>Admin Paneli</span></a>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>
</body>

</html>