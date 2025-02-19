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

// Form verilerini al
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad = $_POST['Ad'];
    $soyad = $_POST['Soyad'];
    $email = $_POST['Email'];
    $sifre = $_POST['Sifre'];

    // Verileri ekle
    $sql = "INSERT INTO uyebilgileri (Ad, Soyad, Email, Sifre) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $ad, $soyad, $email, $sifre);

    if ($stmt->execute()) {
        echo "<div class='success-message'>Kayıt başarılı!</div>";
    } else {
        echo "<div class='error-message'>Hata: " . $conn->error . "</div>";
    }

    $stmt->close();
}

// Bağlantıyı kapat
$conn->close();
?>

<!-- HTML form -->
<div class="form-container">
    <form method="post" action="">
        <h2 class="form-title">Üye Kaydı</h2>
        <label>Ad:</label><input type="text" name="Ad" required><br>
        <label>Soyad:</label><input type="text" name="Soyad" required><br>
        <label>Email:</label><input type="email" name="Email" required><br>
        <label>Şifre:</label><input type="password" name="Sifre" required><br>
        <input type="submit" value="Kayıt Ekle">
    </form>
    
    <!-- Ana Sayfaya Dön Butonu -->
    <div class="back-button-container">
        <a href="admin_index.php" class="back-button">Ana Sayfaya Dön</a>
    </div>
</div>

<!-- CSS for styling -->
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f7f7f7;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        color: #333;
    }

    .form-container {
        background-color: #fff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        max-width: 450px;
        width: 100%;
        text-align: center;
        border-top: 4px solid #f77f00;
        margin-top: 40px;
    }

    .form-title {
        font-size: 26px;
        color: #333;
        margin-bottom: 20px;
        font-weight: 600;
    }

    label {
        font-size: 16px;
        margin-bottom: 8px;
        display: block;
        color: #555;
        margin-top: 12px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
        box-sizing: border-box;
        background-color: #f9f9f9;
        transition: all 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        border-color: #f77f00;
        background-color: #fff;
        box-shadow: 0 0 5px rgba(247, 127, 0, 0.5);
    }

    input[type="submit"] {
        background-color: #f77f00;
        color: white;
        border: none;
        padding: 15px;
        width: 100%;
        font-size: 18px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        margin-top: 15px;
    }

    input[type="submit"]:hover {
        background-color: #f57c00;
        transform: scale(1.05);
    }

    .back-button-container {
        margin-top: 30px;
        text-align: center;
    }

    .back-button {
        background-color: #007bff;
        color: white;
        padding: 12px 30px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 18px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .back-button:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .success-message {
        background-color: #28a745;
        color: white;
        padding: 15px;
        margin-top: 20px;
        border-radius: 8px;
        font-size: 16px;
        text-align: center;
    }

    .error-message {
        background-color: #dc3545;
        color: white;
        padding: 15px;
        margin-top: 20px;
        border-radius: 8px;
        font-size: 16px;
        text-align: center;
    }

</style>
