
<?php
session_start();
$host = 'localhost';
$dbname = 'primefit';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Veritabanı bağlantısı başarısız: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adSoyad = trim($_POST['adSoyad']);
    $email = trim($_POST['email']);
    $sifre = trim($_POST['sifre']);
    $sifreTekrar = trim($_POST['sifreTekrar']);

    if ($sifre !== $sifreTekrar) {
        echo "<script>alert('Şifreler uyuşmuyor!'); window.history.back();</script>";
        exit;
    }

    $query = "UPDATE uyebilgileri SET AdSoyad = :adSoyad, Sifre = :sifre WHERE Email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':adSoyad', $adSoyad);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':sifre', $sifre);

    if ($stmt->execute()) {
        echo "<script>alert('Profil güncellendi!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Profil güncellenemedi!');</script>";
    }
}
?>
