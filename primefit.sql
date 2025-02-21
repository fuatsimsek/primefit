-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 21 Şub 2025, 17:47:08
-- Sunucu sürümü: 9.1.0
-- PHP Sürümü: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `primefit`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `AdminId` int NOT NULL AUTO_INCREMENT,
  `Ad` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `Soyad` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `Email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `Sifre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  PRIMARY KEY (`AdminId`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iletisimbilgileri`
--

DROP TABLE IF EXISTS `iletisimbilgileri`;
CREATE TABLE IF NOT EXISTS `iletisimbilgileri` (
  `Ad` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  `Soyad` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  `EmailAdress` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  `bizeUlasmaSebebiniz` varchar(1500) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sepet`
--

DROP TABLE IF EXISTS `sepet`;
CREATE TABLE IF NOT EXISTS `sepet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `urun_id` int NOT NULL,
  `uye_id` int NOT NULL,
  `adet` int NOT NULL,
  `toplam_fiyat` decimal(10,2) NOT NULL,
  `tarih` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `urun_id` (`urun_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

DROP TABLE IF EXISTS `urunler`;
CREATE TABLE IF NOT EXISTS `urunler` (
  `urun_id` int NOT NULL AUTO_INCREMENT,
  `isim` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  `fiyat` decimal(10,2) NOT NULL,
  PRIMARY KEY (`urun_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`urun_id`, `isim`, `fiyat`) VALUES
(1, 'AMINO 2200', 1559.99),
(2, 'ARGININE X-PLODE', 2999.99),
(3, 'CRASH WEIGHT GAIN', 899.99),
(4, 'GIANT MEGA MASS 4000', 1899.99),
(5, 'L-CARNITINE 1000', 1899.99),
(6, 'L-CARNITINE LIQUID LEM.', 1699.99),
(7, 'L-CARNITINE LIQUID OR.', 1699.99),
(8, 'L-CARNITINE TABLETS', 899.99),
(9, 'MAXIMUM KREA-GENIC', 2499.99),
(10, 'NOS-X10', 2144.99),
(11, 'PREMIUM BCAA PROF.', 1248.99),
(12, 'PREMIUM HYDRO WHEY', 1200.00),
(13, 'PREMIUM WHEY CH.', 1099.99),
(14, 'PREMIUM WHEY ISOLATE', 1599.99),
(15, 'PREMIUM WHEY SV.', 1099.99),
(16, 'PURE CREATINE', 1299.99),
(17, 'SUPER MEGA MASS BA.', 1699.99),
(18, 'SUPER MEGA MASS SB.', 1699.99),
(19, 'ULTRA AMINO PRO', 1160.99),
(20, 'WHEY AMINOS', 1390.00);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyebilgileri`
--

DROP TABLE IF EXISTS `uyebilgileri`;
CREATE TABLE IF NOT EXISTS `uyebilgileri` (
  `UyeId` int NOT NULL AUTO_INCREMENT,
  `Ad` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `Soyad` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `Email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `Sifre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  PRIMARY KEY (`UyeId`),
  UNIQUE KEY `UyeId` (`UyeId`,`Ad`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
