<?php
session_start();
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Email'];
    $sifre = $_POST['Sifre'];

    // E-posta ve şifreyi kontrol et
    $sql = "SELECT AdminId, Ad, Soyad FROM admin WHERE Email = ? AND Sifre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $sifre);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Giriş başarılı
        $stmt->bind_result($adminId, $ad, $soyad);
        $stmt->fetch();

        // Oturum bilgilerini sakla
        $_SESSION['admin_id'] = $adminId;
        $_SESSION['admin_ad'] = $ad;
        $_SESSION['admin_soyad'] = $soyad;

        // Ana sayfaya yönlendir
        header("Location: admin_index.php");
        exit();
    } else {
        echo "<p class='error-message'>E-posta veya şifre hatalı!</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!-- HTML form -->
<form method="POST" action="">
    <h2>Admin Giriş</h2>
    <label for="Email">E-posta:</label>
    <input type="email" id="Email" name="Email" required><br>
    
    <label for="Sifre">Şifre:</label>
    <input type="password" id="Sifre" name="Sifre" required><br>
    
    <input type="submit" value="Giriş Yap">
    
    <!-- Geri Dön Butonu -->
    <a href="index.php" class="back-link">Geri Dön</a>
</form>

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
    }

    form {
        background-color: #fff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    h2 {
        margin-bottom: 30px;
        color: #333;
        font-size: 24px;
        font-weight: bold;
    }

    label {
        font-size: 16px;
        color: #333;
        margin-bottom: 8px;
        display: block;
        text-align: left;
    }

    input[type="email"], input[type="password"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 18px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 16px;
        background-color: #f9f9f9;
    }

    input[type="submit"] {
        width: 100%;
        padding: 12px;
        background-color: #ff6600;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #f57c00;
    }

    .error-message {
        color: #d9534f;
        font-size: 16px;
        margin-top: 20px;
    }

    /* Geri Dön Linki */
    .back-link {
        display: block;
        margin-top: 20px;
        color: #007bff;
        font-size: 18px;
        font-weight: bold;
        text-decoration: none;
    }

    .back-link:hover {
        text-decoration: none;
    }
</style>
