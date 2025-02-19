<?php
// Oturumu başlat
session_start();

// Oturumda aktif olan tüm değişkenleri temizle
session_unset();

// Oturumu sonlandır
session_destroy();

// Kullanıcıyı ana sayfaya yönlendir
header("Location: admin_index.php");
exit();
?>