<?php
session_start();

// Admin giriş yapmış mı kontrol et
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Admin bilgilerini al
$adminAd = $_SESSION['admin_ad'];
$adminSoyad = $_SESSION['admin_soyad'];
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to bottom, #ff6600, #f57c00);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .container {
            width: 100%;
            max-width: 900px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .header {
            background-color: #fff;
            padding: 30px;
            text-align: center;
            color: #333;
        }

        .header h1 {
            margin: 0;
            font-size: 36px;
            font-weight: bold;
        }

        .admin-info {
            font-size: 18px;
            margin-top: 10px;
            color: #333;
            font-weight: bold;
        }

        .menu {
            padding: 30px;
            display: grid;
            gap: 20px;
            background-color: #f4f4f4;
            border-top: 2px solid #ff6600;
        }

        .menu a {
            padding: 15px;
            background-color: #f77f00;
            color: white;
            text-decoration: none;
            font-size: 18px;
            border-radius: 8px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .menu a:hover {
            background-color: #f57c00;
            transform: scale(1.05);
        }

        .logout {
            padding: 15px;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .logout:hover {
            background-color: #c0392b;
            transform: scale(1.05);
        }

    </style>
        <title>PRIME FIT</title>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Hoşgeldiniz, Admin!</h1>
        <div class="admin-info">
            <p>Ad: <?php echo $adminAd; ?></p>
            <p>Soyad: <?php echo $adminSoyad; ?></p>
        </div>
    </div>

    <div class="menu">
        <a href="admin_bilgiGoster.php">Kayıtlı Üyeleri Döndür</a>
        <a href="admin_kayitekle.php">Üye Ekle</a>
        <a href="admin_kayitsil.php">Üye Sil</a>
        <a href="admin_kullanici_duzenle.php">Üye Bilgilerini Güncelle</a>
        <a href="admin_urunler.php">Ürün Güncelle</a>
        <a href="admin_iletisim.php">İletişim Menüsü</a> <!-- Yeni bağlantı -->
        <a href="admin_siparis.php">Siparişleri Görüntüle</a>
    </div>

    <div class="logout">
        <a href="admin_logout.php" style="text-decoration:none;color:white;">Çıkış Yap</a>
    </div>
</div>

</body>
</html>
