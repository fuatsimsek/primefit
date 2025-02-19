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

// Kullanıcıları listeleme
$sql = "SELECT UyeId, Ad, Soyad, Email FROM uyebilgileri";
$result = $conn->query($sql);

// Sayfa başlık ve stil
echo "<html><head><title>Kullanıcı Bilgileri Güncelle</title>";
echo "<style>
/* Genel Stil */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #e9eff1;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background-color: white;
    width: 80%;
    max-width: 1000px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    padding: 40px;
    box-sizing: border-box;
}

h2 {
    text-align: center;
    font-size: 28px;
    color: #333;
    margin-bottom: 20px;
}

/* Tablo Stili */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 30px;
}

table th, table td {
    padding: 15px;
    text-align: left;
    font-size: 18px;
    color: #555;
    border: 1px solid #ddd;
}

table th {
    background-color: #ff6600;
    color: white;
    font-size: 20px;
}

table tr:nth-child(even) {
    background-color: #f5f5f5;
}

/* Düzenleme Butonu */
.edit-btn {
    display: inline-block;
    background-color: #28a745;
    color: white;
    padding: 8px 16px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
}

.edit-btn:hover {
    background-color: #218838;
}

/* Geri Dön Linki */
.back-link {
    display: block;
    text-align: center;
    color: #007bff;
    font-size: 20px;
    margin-top: 20px;
    text-decoration: none;
    font-weight: bold;
}

.back-link:hover {
    text-decoration: underline;
}
</style></head><body>";

echo "<div class='container'>";
echo "<a href='admin_index.php' class='back-link'>Ana Sayfaya Dön</a>";

echo "<h2>Kullanıcı Bilgilerini Güncelle</h2>";

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Üye ID</th><th>Ad</th><th>Soyad</th><th>Email</th><th>İşlem</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["UyeId"] . "</td>
                <td>" . $row["Ad"] . "</td>
                <td>" . $row["Soyad"] . "</td>
                <td>" . $row["Email"] . "</td>
                <td><a href='admin_kullanici_duzenle_form.php?id=" . $row["UyeId"] . "' class='edit-btn'>Güncelle</a></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center; font-size: 18px;'>Kullanıcı bulunamadı.</p>";
}

echo "</div>";
$conn->close();

echo "</body></html>";
?>
