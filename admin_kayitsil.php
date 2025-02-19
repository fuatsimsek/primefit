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
echo "<a href='admin_index.php' class='back-link'>Ana Sayfaya Dön</a> <br>";

// Form verilerini al
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uyeId = $_POST['UyeId'];

    // Veriyi sil
    $sql = "DELETE FROM uyebilgileri WHERE UyeId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $uyeId);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "<div class='success-message'>Kayıt başarıyla silindi!</div>";
        } else {
            echo "<div class='error-message'>Silinecek kayıt bulunamadı!</div>";
        }

    } else {
        echo "<div class='error-message'>Hata: " . $conn->error . "</div>";
    }

    $stmt->close();
}

// Kayıtlı üyeleri listeleme
$result = $conn->query("SELECT UyeId, Ad, Soyad FROM uyebilgileri");

if ($result->num_rows > 0) {
    echo "<h2 class='user-list-title'>Kayıtlı Üyeler</h2>";
    echo "<table class='user-list-table'>";
    echo "<tr><th>Üye ID</th><th>Ad</th><th>Soyad</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['UyeId'] . "</td><td>" . $row['Ad'] . "</td><td>" . $row['Soyad'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "<div class='error-message'>Kayıtlı üye bulunamadı.</div>";
}

// Bağlantıyı kapat
$conn->close();
?>

<!-- HTML form -->
<form method="post" action="" class="delete-form">
    <div class="form-container">
        <h2>Üye Sil</h2>
        <label for="UyeId">Silinecek Üye ID:</label>
        <input type="number" name="UyeId" id="UyeId" required><br>
        <input type="submit" value="Üye Sil">
    </div>
</form>

<!-- CSS for styling -->
<style>
    body {
        font-family: 'Roboto', Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        color: #212529;
    }

    .form-container {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 500px;
        margin-bottom: 20px;
    }

    .delete-form {
        margin: 20px 0;
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
    }

    input[type="number"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        border: 1px solid #ced4da;
        border-radius: 10px;
        font-size: 16px;
        box-sizing: border-box;
        background-color: #e9ecef;
        transition: all 0.3s;
    }

    input[type="number"]:focus {
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

    .user-list-title {
        font-size: 24px;
        font-weight: 600;
        margin-top: 30px;
        text-align: center;
        color: #343a40;
    }

    .user-list-table {
        width: 90%;
        margin-top: 20px;
        border-collapse: collapse;
        border: 1px solid #dee2e6;
    }

    th, td {
        padding: 14px;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
        color: #495057;
    }

    th {
        background-color: #f1f3f5;
        font-weight: 600;
    }

    .back-link {
        color: #007bff;
        font-size: 16px;
        text-decoration: none;
        margin: 20px 0;
        display: inline-block;
        transition: color 0.3s;
    }

    .back-link:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    .error-message,
    .success-message {
        font-size: 16px;
        padding: 15px;
        margin-top: 20px;
        border-radius: 8px;
        text-align: center;
    }

    .error-message {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .success-message {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
</style>
