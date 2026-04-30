<?php
// Data sederhana (bisa dikembangkan ke database nanti)
$nama_perumahan = "Graha Permata Indah Jember";
$tagline = "Hunian Nyaman, Asri, dan Strategis di Jember";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $nama_perumahan; ?></title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            line-height: 1.6;
        }

        header {
            background: #2c7a7b;
            color: white;
            padding: 15px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            font-size: 20px;
        }

        nav a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
        }

        .hero {
            background: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa') no-repeat center/cover;
            height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .hero h2 {
            font-size: 40px;
            background: rgba(0,0,0,0.5);
            padding: 20px;
        }

        .container {
            padding: 50px;
        }

        .section-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .features {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .feature-box {
            width: 30%;
            background: #f4f4f4;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            text-align: center;
        }

        .cta {
            background: #2c7a7b;
            color: white;
            text-align: center;
            padding: 40px;
        }

        .cta a {
            background: white;
            color: #2c7a7b;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        footer {
            text-align: center;
            padding: 20px;
            background: #333;
            color: white;
        }

        @media(max-width: 768px){
            .feature-box {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<header>
    <h1><?= $nama_perumahan; ?></h1>
    <nav>
        <a href="#">Home</a>
        <a href="#tentang">Tentang</a>
        <a href="#fasilitas">Fasilitas</a>
        <a href="#kontak">Kontak</a>
    </nav>
</header>

<section class="hero">
    <h2><?= $tagline; ?></h2>
</section>

<section class="container" id="tentang">
    <h2 class="section-title">Tentang Perumahan</h2>
    <p style="text-align:center;">
        <?= $nama_perumahan; ?> merupakan kawasan hunian modern di Jember 
        yang menawarkan kenyamanan, keamanan, dan akses strategis ke pusat kota.
    </p>
</section>

<section class="container" id="fasilitas">
    <h2 class="section-title">Fasilitas Unggulan</h2>
    <div class="features">
        <div class="feature-box">
            <h3>Keamanan 24 Jam</h3>
            <p>Lingkungan aman dengan sistem keamanan terpadu.</p>
        </div>
        <div class="feature-box">
            <h3>Lingkungan Asri</h3>
            <p>Udara segar dengan taman hijau yang nyaman.</p>
        </div>
        <div class="feature-box">
            <h3>Lokasi Strategis</h3>
            <p>Dekat dengan sekolah, pasar, dan fasilitas umum.</p>
        </div>
    </div>
</section>

<section class="cta" id="kontak">
    <h2>Segera Miliki Hunian Impian Anda</h2>
    <p>Hubungi kami untuk informasi lebih lanjut</p>
    <br>
    <a href="#">Hubungi Kami</a>
</section>

<footer>
    <p>&copy; <?= date("Y"); ?> <?= $nama_perumahan; ?> | All Rights Reserved</p>
</footer>

</body>
</html>
