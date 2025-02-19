<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Düzenleme</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styleurunler.css">
    <title>PRIME FIT</title>
</head>

<body>
    <section class="ustMenu">
        <div class="navbarMenu">
            <!-- Logo ve Başlık -->
            <div class="siteLogoVeBaslik">
                <div class="siteLogo">
                    <a class="logoa" href="index.php"><img src="images/myLogo.png" alt="Logo" width="200px"></a>
                </div>
                <!-- <div class="siteBaslik">
                    <a class="titlea" href="index.php">
                        <h3 class="title">PRIME FIT</h3>
                    </a>
                </div> -->
            </div>

            <!-- Arama ve Menü -->
            <div class="aramaVeIcerik">
                <!-- <div class="arama">
                    <input type="search" placeholder="Arama Yapın">
                    <form><button class="searchBtn">Ara</button></form>
                </div> -->
                <div class="icerik">
                    <ul class="kategoriler">
                        <li><a href="index.php">Anasayfa</a></li>
                        <li class="kategoriGosterimi">
                            <a class="kategoris" href="#">Ürünlerimiz</a>
                            <ul class="altKategoriler">
                                <li><a href="proteintozu.php"> PROTEİN TOZU</a></li>
                                <li><a href="aminoasit.php"> AMİNO ASİT</a></li>
                                <li><a href="karbonhidrat.php"> KARBONHİDRAT</a></li>
                                <li><a href="l-carnitine.php"> L-CARNITINE</a></li>
                                <li><a href="enerjikaynaklari.php"> ENERJİ KAYNAKLARI</a></li>
                                <!-- <li><a href="#">👕 Giyim ve Aksesuarlar</a></li>
                                <li><a href="#">💪 Fitness ve Sağlık Ürünleri</a></li> -->
                            </ul>
                        </li>
                        <li><a href="hakkinda.php">Hakkımızda</a></li>
                        <li><a href="iletisim.php">İletişim</a></li>
                    </ul>
                </div>
            </div>

            <!-- Giriş ve Sepet -->
            <div class="girisVeSepet">
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="kart">
                    <a href="profilim.php">👤 Profilim</a>
                </div>
                <div class="kart">
                    <a href="cikis.php">Çıkış Yap</a>
                </div>
            <?php else: ?>
                <div class="kart">
                    <a href="girisyap.php">👤 Giriş Yap/Kayıt Ol</a>
                </div>
            <?php endif; ?>
            <div class="profil">
                <a href="urunler/sepet.php">🛒 Sepet</a>
            </div>
        </div>
        </div>
        <div class="info-bar">
            <div class="info-item">
                <img src="images/protect.png" alt="Güvenli Alışveriş" width="24" height="24">
                <span>- Tüm Bilgileriniz Güvende</span>
            </div>
            <div class="info-item">
                <img src="images/shipping.png" alt="Aynı Gün Kargo" width="24" height="24">
                <span>- Aynı Gün Kargoda</span>
            </div>
            <div class="info-item">
                <img src="images/return.png" alt="Ücretsiz İade" width="24" height="24">
                <span>- 14 Gün İçinde Koşulsuz İade</span>
            </div>
            <div class="info-item">
                <img src="images/support.png" alt="Müşteri Desteği" width="24" height="24">
                <span>- İhtiyacınız Olan Her An</span>
            </div>
        </div>

    </section>

    <section class="cardMenuTitleandMenu">
        <div class="cardTitle">
            <h2 class="cardBaslik">PROTEİN TOZU</h2>
        </div>
        <div class="cardMenu d-flex justify-content-around">
            <div class="card" style="width: 18rem;">
                <img src="images/PREMIUM HYDRO WHEY.webp" class="card-img-top cardImg" alt="..." height="65%">
                <div class="card-body">
                    <h5 class="card-title">PRIME FIT</h5>
                    <p class="card-text myCardText">PREMIUM HYDRO WHEY</p>
                    <a href="urunler/PREMIUM HYDRO WHEY.php" class="btn btn-primary sepetEklelButon"><span class="inceleBtnText">İNCELE</span></a>
                    <!-- <span class="etiketFiyat">690 TL</span><span class="delFiyat">840TL</span> -->
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="images/PREMIUM WHEY ISOLATE.webp" class="card-img-top cardImg" alt="..." height="65%">
                <div class="card-body">
                    <h5 class="card-title">PRIME FIT</h5>
                    <p class="card-text myCardText">PREMIUM WHEY ISOLATE</p>
                    <a href="urunler/PREMIUM WHEY ISOLATE.php" class="btn btn-primary sepetEklelButon"><span class="inceleBtnText">İNCELE</span></a>
                    <!-- <span class="etiketFiyat">690 TL</span><span class="delFiyat">840TL</span> -->
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="images/PREMIUM WHEY.webp" class="card-img-top cardImg" alt="..." height="65%">
                <div class="card-body">
                    <h5 class="card-title">PRIME FIT</h5>
                    <p class="card-text myCardText">PREMIUM WHEY CH.</p>
                    <a href="urunler/PREMIUM WHEY CH..php" class="btn btn-primary sepetEklelButon"><span class="inceleBtnText">İNCELE</span></a>
                    <!-- <span class="etiketFiyat">690 TL</span><span class="delFiyat">840TL</span> -->
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="images/PREMIUM WHEY.webp" class="card-img-top cardImg" alt="..." height="65%">
                <div class="card-body">
                    <h5 class="card-title">PRIME FIT</h5>
                    <p class="card-text myCardText">PREMIUM WHEY S&V.</p>
                    <a href="urunler/PREMIUM WHEY SV..php" class="btn btn-primary sepetEklelButon"><span class="inceleBtnText">İNCELE</span></a>
                    <!-- <span class="etiketFiyat">690 TL</span><span class="delFiyat">840TL</span> -->
                </div>
            </div>
        </div>
    </section>

    <section class="footerMenu">
        <div class="footer">
            <div class="siteLogoVeBaslik" id="footerLogoVeBaslik">
                <div class="siteLogo">
                    <a class="logoa" href="index.php"><img src="images/myLogo.png" alt="Logo" width="200px"></a>
                </div>
                <!-- <div class="siteBaslik">
                    <a class="titlea" href="index.php">
                        <h3 class="title">PRIME FIT</h3>
                    </a>
                </div> -->
            </div>
            <p class="footer-text">© 2024 Tüm Hakları Saklıdır.</p>
            <div class="sosyalMedya">
                <a href="#"><img src="images/ig-logo.png" width="45px" height="45px" alt="İnstagram"></a>
                <a href="#"><img src="images/fb-logo.png" width="45px" height="45px" alt="Facebook"></a>
                <a href="#"><img src="images/x-logo.png" width="40px" height="40px" alt="X"></a>
            </div>
            <a href="admin_login.php" style="text-decoration: none; color: gray;"><span>Admin Paneli</span></a>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>
</body>

</html>