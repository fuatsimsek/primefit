<?php
session_start();

// Admin giriş kontrolü
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = ""; // Veritabanı şifreniz
$dbname = "primefit"; // Veritabanı adı

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Yeni ürün ekleme
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ekle'])) {
    $isim = $_POST['isim'];
    $fiyat = $_POST['fiyat'];

    $sql = "INSERT INTO urunler (isim, fiyat) VALUES ('$isim', '$fiyat')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Ürün başarıyla eklendi!');</script>";
    } else {
        echo "<script>alert('Ürün eklenirken hata oluştu: " . $conn->error . "');</script>";
    }
}

// Ürün silme
if (isset($_GET['sil'])) {
    $urun_id = $_GET['sil'];
    $sql = "DELETE FROM urunler WHERE urun_id = $urun_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Ürün başarıyla silindi!');</script>";
    } else {
        echo "<script>alert('Ürün silinirken hata oluştu: " . $conn->error . "');</script>";
    }
}

// Ürün güncelleme
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guncelle'])) {
    $urun_id = $_POST['urun_id'];
    $isim = $_POST['isim'];
    $fiyat = $_POST['fiyat'];

    $sql = "UPDATE urunler SET isim='$isim', fiyat='$fiyat' WHERE urun_id=$urun_id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Ürün başarıyla güncellendi!');</script>";
    } else {
        echo "<script>alert('Ürün güncellenirken hata oluştu: " . $conn->error . "');</script>";
    }
}

// Ürünleri veritabanından çek
$sql = "SELECT * FROM urunler";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Yönetimi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }

        .container {
            width: 90%;
            margin: auto;
            margin-top: 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        table th {
            background-color: #f77f00;
            color: #fff;
        }

        form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        form input[type="text"], form input[type="number"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: calc(100% - 20px);
        }

        form button {
            padding: 10px 20px;
            background-color: #f77f00;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #f57c00;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        .back-btn {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .back-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="admin_index.php" style="text-decoration: none;">
            <button class="back-btn">Ana Sayfaya Dön</button>
        </a>
        <h1>Ürün Yönetimi</h1>

        <!-- Yeni Ürün Ekleme -->
        <form method="POST">
            <input type="text" name="isim" placeholder="Ürün İsmi" required>
            <input type="number" name="fiyat" placeholder="Ürün Fiyatı" required>
            <button type="submit" name="ekle">Ürün Ekle</button>
        </form>

        <!-- Ürünler Tablosu -->
        <table>
            <thead>
                <tr>
                    <th>Ürün ID</th>
                    <th>İsim</th>
                    <th>Fiyat</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <form method="POST">
                                <td><?php echo $row['urun_id']; ?></td>
                                <td>
                                    <input type="text" name="isim" value="<?php echo $row['isim']; ?>">
                                </td>
                                <td>
                                    <input type="number" name="fiyat" value="<?php echo $row['fiyat']; ?>">
                                </td>
                                <td>
                                    <input type="hidden" name="urun_id" value="<?php echo $row['urun_id']; ?>">
                                    <button type="submit" name="guncelle">Güncelle</button>
                                    <a href="?sil=<?php echo $row['urun_id']; ?>" class="delete-btn">Sil</a>
                                </td>
                            </form>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Kayıtlı ürün bulunamadı.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
