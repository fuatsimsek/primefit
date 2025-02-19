<script src="/js/ajax.js"></script>

<?php
session_start();


// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "primefit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Kullanıcı giriş kontrolü
if (!isset($_SESSION['user_id'])) {
    header("Location: girisyap.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Kullanıcı bilgilerini çekme
$sql = "SELECT * FROM uyebilgileri WHERE UyeId=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Profil güncelleme işlemi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];

    $update_sql = "UPDATE uyebilgileri SET Ad=?, Soyad=?, Email=?, Sifre=? WHERE UyeId=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssssi", $ad, $soyad, $email, $sifre, $user_id);

    if ($update_stmt->execute()) {
        echo "<script>alert('Bilgileriniz güncellendi!');</script>";
    } else {
        echo "<script>alert('Güncelleme başarısız!');</script>";
    }
}

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
        <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        h2 {
            font-weight: 700;
            color: #333333;
        }
    </style>
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
                <!-- <div class="siteBaslik">
                    <a class="titlea" href="index.php">
                        <h3 class="title">PRIME FIT</h3>
                    </a>
                </div> -->
            </div>

            <!-- Arama ve Menü -->
            <div class="aramaVeIcerik">
                <!-- <div class="arama">
                    <input type="search" placeholder="Arama Yapın">
                    <form><button class="searchBtn">Ara</button></form>
                </div> -->
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
                                <!-- <li><a href="#">👕 Giyim ve Aksesuarlar</a></li>
                                <li><a href="#">💪 Fitness ve Sağlık Ürünleri</a></li> -->
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

    <section class="container mt-5">
    <div class="card shadow p-4 mb-5 bg-white rounded">
        <h2 class="text-center mb-4">Profil Bilgilerim</h2>
        <form method="POST">
            <div class="form-group">
                <label>Ad:</label>
                <input type="text" name="ad" class="form-control" value="<?php echo htmlspecialchars($user['Ad']); ?>" required>
            </div>
            <div class="form-group">
                <label>Soyad:</label>
                <input type="text" name="soyad" class="form-control" value="<?php echo htmlspecialchars($user['Soyad']); ?>" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['Email']); ?>" required>
            </div>
            <div class="form-group">
                <label>Şifre:</label>
                <input type="password" name="sifre" class="form-control" value="<?php echo htmlspecialchars($user['Sifre']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Güncelle</button>
        </form>
    </div>
</section>

    <section class="footerMenu">
        <div class="footer">
            <div class="siteLogoVeBaslik" id="footerLogoVeBaslik">
                <div class="siteLogo">
                    <a class="logoa" href="index.php"><img src="images/myLogo.png" alt="Logo" width="200px"></a>
                </div>
                <!-- <div class="siteBaslik">
                    <a class="titlea" href="index.php">
                        <h3 class="title">PRIME FIT</h3>
                    </a>
                </div> -->
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