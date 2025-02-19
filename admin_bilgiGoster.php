<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "primefit";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) die("Bağlantı başarısız: " . $conn->connect_error);

$sql = "SELECT UyeId, Ad, Soyad, Email, Sifre FROM uyebilgileri";
$result = $conn->query($sql);
echo "<a href='admin_index.php' class='back-link'>Ana Sayfaya Dön</a><br>";
if ($result->num_rows > 0) {
    echo "<div class='table-container'><table><thead><tr><th>UyeId</th><th>Ad</th><th>Soyad</th><th>Email</th><th>Sifre</th></tr></thead><tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["UyeId"] . "</td><td>" . $row["Ad"] . "</td><td>" . $row["Soyad"] . "</td><td>" . $row["Email"] . "</td><td>" . $row["Sifre"] . "</td></tr>";
    }
    echo "</tbody></table></div>";
} else {
    echo "<p>Kayıt bulunamadı.</p>";
}

$conn->close();
?>

<!-- CSS for styling -->
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
    }
    .back-link {
        display: inline-block;
        background-color: #007bff;
        color: white;
        padding: 12px 20px;
        border-radius: 5px;
        text-decoration: none;
        margin: 20px;
        font-size: 18px;
        transition: background-color 0.3s ease;
    }
    .back-link:hover {
        background-color: #045bff;
    }
    .table-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        max-width: 1000px;
        margin: 40px auto;
        overflow-x: auto;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 14px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        font-size: 16px;
    }
    th {
        background-color: #f8f8f8;
        color: #333;
        font-weight: bold;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #f1f1f1;
    }
    p {
        font-size: 18px;
        color: #333;
        text-align: center;
    }
</style>
