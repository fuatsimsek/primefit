<?php
session_start();

// Admin giriş yapmış mı kontrol et
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Veritabanı bağlantısı bilgileri
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "primefit";

// Bağlantıyı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Doğru sütun adlarını kullanarak sorguyu oluştur
$sql = "SELECT Ad, Soyad, EmailAdress, bizeUlasmaSebebiniz FROM iletisimbilgileri";
$result = $conn->query($sql);

// Eğer hata oluşursa kontrol edin
if (!$result) {
    die("Sorgu başarısız: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim Bilgileri</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f57c00;
            color: white;
            font-weight: bold;
        }

        .back-link {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #f57c00;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .back-link:hover {
            background-color: #ff6600;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>İletişim Bilgileri</h1>
    <table>
        <thead>
            <tr>
                <th>Ad</th>
                <th>Soyad</th>
                <th>Email Adresi</th>
                <th>Mesaj İçeriği</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['Ad']); ?></td>
                        <td><?php echo htmlspecialchars($row['Soyad']); ?></td>
                        <td><?php echo htmlspecialchars($row['EmailAdress']); ?></td>
                        <td><?php echo htmlspecialchars($row['bizeUlasmaSebebiniz']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Hiçbir iletişim bilgisi bulunamadı.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="admin_index.php" class="back-link">Ana Sayfaya Dön</a>
</div>
</body>
</html>

<?php
// Bağlantıyı kapat
$conn->close();
?>
