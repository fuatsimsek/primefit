<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "primefit";

// Bağlantıyı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
}

// Kullanıcı ID'si al
$uyeId = $_GET['id'];

// Kullanıcı bilgilerini getir
$sql = "SELECT * FROM uyebilgileri WHERE UyeId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $uyeId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "<div class='error-message'>Kullanıcı bulunamadı.</div>";
    exit();
}

// Kullanıcı bilgilerini güncelleme
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad = $_POST['Ad'];
    $soyad = $_POST['Soyad'];
    $email = $_POST['Email'];
    $sifre = $_POST['Sifre'];

    // Şifreyi hash'leme
    $hashedSifre = password_hash($sifre, PASSWORD_DEFAULT);

    // Güncelleme sorgusu
    $sql = "UPDATE uyebilgileri SET Ad = ?, Soyad = ?, Email = ?, Sifre = ? WHERE UyeId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $ad, $soyad, $email, $hashedSifre, $uyeId);

    if ($stmt->execute()) {
        echo "<div class='success-message'>Kullanıcı başarıyla güncellendi!</div>";
    } else {
        echo "<div class='error-message'>Hata: " . $conn->error . "</div>";
    }

    $stmt->close();
}

$conn->close();
?>

<!-- HTML form -->
<html>
<head>
    <title>Kullanıcı Bilgilerini Düzenle</title>
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #212529;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        h2 {
            font-size: 28px;
            font-weight: 700;
            color: #495057;
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            margin-bottom: 10px;
            display: block;
            color: #6c757d;
            text-align: left;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 10px;
            font-size: 16px;
            background-color: #e9ecef;
            transition: all 0.3s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #495057;
            background-color: #ffffff;
            box-shadow: 0 0 5px rgba(73, 80, 87, 0.5);
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 14px;
            font-size: 18px;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
            transform: scale(1.02);
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            font-size: 16px;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: #0056b3;
        }

        .error-message {
            font-size: 16px;
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .success-message {
            font-size: 16px;
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Kullanıcı Bilgilerini Düzenle</h2>
        <form method="post" action="">
            <label>Ad:</label>
            <input type="text" name="Ad" value="<?php echo htmlspecialchars($user['Ad']); ?>" required>
            <label>Soyad:</label>
            <input type="text" name="Soyad" value="<?php echo htmlspecialchars($user['Soyad']); ?>" required>
            <label>Email:</label>
            <input type="email" name="Email" value="<?php echo htmlspecialchars($user['Email']); ?>" required>
            <label>Şifre:</label>
            <input type="password" name="Sifre" required>
            <input type="submit" value="Güncelle">
        </form>
        <a href="admin_kullanici_duzenle.php" class="back-link">Geri Dön</a>
    </div>
</body>
</html>