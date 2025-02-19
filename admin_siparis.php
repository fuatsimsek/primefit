<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "primefit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Silme işlemi
if (isset($_GET['sil'])) {
    $id = intval($_GET['sil']);
    $sql = "DELETE FROM sepet WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Sipariş başarıyla silindi!'); window.location.href='admin_siparis.php';</script>";
    } else {
        echo "<script>alert('Silme işlemi başarısız oldu.');</script>";
    }
}

// Sepet verilerini ürün isimleriyle birlikte çekme
$sql = "
    SELECT sepet.*, urunler.isim AS urun_ismi 
    FROM sepet 
    LEFT JOIN urunler ON sepet.urun_id = urunler.urun_id
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepet Yönetimi</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #343a40;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        th {
            background-color: #343a40;
            color: #fff;
        }
        tr:hover {
            background-color: #f1f3f5;
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sepet Yönetimi</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ürün ID</th>
                    <th>Ürün İsmi</th>
                    <th>Üye ID</th>
                    <th>Adet</th>
                    <th>Toplam Fiyat</th>
                    <th>Tarih</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['urun_id']) ?></td>
                            <td><?= htmlspecialchars($row['urun_ismi']) ?></td>
                            <td><?= htmlspecialchars($row['uye_id']) ?></td>
                            <td><?= htmlspecialchars($row['adet']) ?></td>
                            <td><?= htmlspecialchars($row['toplam_fiyat']) ?></td>
                            <td><?= htmlspecialchars($row['tarih']) ?></td>
                            <td>
                                <a class="btn btn-danger" href="?sil=<?= $row['id'] ?>" onclick="return confirm('Bu siparişi silmek istediğinize emin misiniz?');">
                                    <i class="fas fa-trash"></i> Sil
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Sepet boş.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="text-center">
            <a class="btn btn-primary" href="admin_index.php">
                <i class="fas fa-home"></i> Ana Sayfaya Dön
            </a>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
