<?php
session_start();

// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "primefit";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Bağlantı hatası: " . $e->getMessage());
}

// Sepet işlemleri
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $urun_id = intval($_POST['urun_id'] ?? 0);
    $islem = $_POST['islem'] ?? '';

    if ($urun_id > 0) {
        $stmt = $conn->prepare("SELECT urun_id, isim, fiyat FROM urunler WHERE urun_id = :urun_id");
        $stmt->execute(['urun_id' => $urun_id]);
        $urun = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($urun) {
            if (!isset($_SESSION['sepet'][$urun_id])) {
                $_SESSION['sepet'][$urun_id] = [
                    'isim' => $urun['isim'],
                    'fiyat' => $urun['fiyat'],
                    'adet' => 1
                ];
            } else {
                if ($islem === 'ekle' || $islem === 'artir') {
                    $_SESSION['sepet'][$urun_id]['adet']++;
                } elseif ($islem === 'azalt') {
                    if ($_SESSION['sepet'][$urun_id]['adet'] > 1) {
                        $_SESSION['sepet'][$urun_id]['adet']--;
                    } else {
                        unset($_SESSION['sepet'][$urun_id]);
                    }
                }
            }
        }
    }
}

// Sepetten ürün silme işlemi
if (isset($_GET['sil'])) {
    $sil_id = intval($_GET['sil']);
    unset($_SESSION['sepet'][$sil_id]);
}

// Kullanıcı oturum kontrolü ve satın alma işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['satin_al'])) {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../girisyap.php");
        exit;
    }

    $uye_id = $_SESSION['user_id'];

    if (!empty($_SESSION['sepet'])) {
        $stmt = $conn->prepare("INSERT INTO sepet (urun_id, uye_id, adet, toplam_fiyat, tarih) VALUES (:urun_id, :uye_id, :adet, :toplam_fiyat, NOW())");

        foreach ($_SESSION['sepet'] as $urun_id => $urun) {
            $adet = $urun['adet'];
            $toplam_fiyat = $urun['fiyat'] * $adet;
            $stmt->execute([
                'urun_id' => $urun_id,
                'uye_id' => $uye_id,
                'adet' => $adet,
                'toplam_fiyat' => $toplam_fiyat
            ]);
        }
        $_SESSION['sepet'] = [];
        echo "<script>alert('Satın alındı! Teşekkür ederiz.'); window.location.href = '../index.php';</script>";
        exit;
    } else {
        $_SESSION['satin_al_mesaj'] = "Sepetiniz boş!";
    }
}

$satin_al_mesaj = $_SESSION['satin_al_mesaj'] ?? null;
if ($satin_al_mesaj) {
    unset($_SESSION['satin_al_mesaj']);
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>PRIME FIT</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Alışveriş Sepeti</h1>

        <?php if (!empty($_SESSION['sepet'])): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Ürün</th>
                        <th>Fiyat</th>
                        <th>Adet</th>
                        <th>Toplam</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $genel_toplam = 0;
                    foreach ($_SESSION['sepet'] as $urun_id => $urun):
                        $toplam = $urun['fiyat'] * $urun['adet'];
                        $genel_toplam += $toplam;
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($urun['isim']) ?></td>
                            <td>₺<?= number_format($urun['fiyat'], 2) ?></td>
                            <td><?= $urun['adet'] ?></td>
                            <td>₺<?= number_format($toplam, 2) ?></td>
                            <td>
                                <form method="POST" action="sepet.php" style="display: inline;">
                                    <input type="hidden" name="urun_id" value="<?= $urun_id ?>">
                                    <input type="hidden" name="islem" value="artir">
                                    <button type="submit" class="btn btn-sm btn-success">+</button>
                                </form>
                                <form method="POST" action="sepet.php" style="display: inline;">
                                    <input type="hidden" name="urun_id" value="<?= $urun_id ?>">
                                    <input type="hidden" name="islem" value="azalt">
                                    <button type="submit" class="btn btn-sm btn-warning">-</button>
                                </form>
                                <a href="sepet.php?sil=<?= $urun_id ?>" class="btn btn-sm btn-danger">Sil</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"><strong>Genel Toplam</strong></td>
                        <td>₺<?= number_format($genel_toplam, 2) ?></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <div class="d-flex justify-content-between">
                <a href="../index.php" class="btn btn-primary">Alışverişe Devam Et</a>
                <form method="POST" action="">
                    <button type="submit" name="satin_al" class="btn btn-success">Satın Al</button>
                </form>
            </div>
        <?php else: ?>
            <p class="alert alert-warning">Sepetiniz boş!</p>
            <a href="../index.php" class="btn btn-primary">Alışverişe Devam Et</a>
        <?php endif; ?>
    </div>
</body>
</html>
