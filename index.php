<?php
$nama_perumahan = "Graha Permata Indah Jember";
$tagline = "Hunian Nyaman, Asri, dan Strategis di Jember";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $nama_perumahan; ?></title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2c7a7b',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100">

<!-- Navbar -->
<header class="bg-primary text-white shadow-md">
    <div class="container mx-auto flex justify-between items-center p-4">
        <h1 class="font-bold text-lg"><?= $nama_perumahan; ?></h1>
        <nav class="space-x-4">
            <a href="#" class="hover:underline">Home</a>
            <a href="#tentang" class="hover:underline">Tentang</a>
            <a href="#fasilitas" class="hover:underline">Fasilitas</a>
            <a href="#kontak" class="hover:underline">Kontak</a>
        </nav>
    </div>
</header>

<!-- Hero -->
<section class="h-screen bg-cover bg-center flex items-center justify-center"
    style="background-image: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa');">
    
    <div class="bg-black bg-opacity-60 p-10 rounded-xl text-center text-white">
        <h2 class="text-4xl font-bold mb-4"><?= $tagline; ?></h2>
        <p class="mb-6">Temukan rumah impian Anda bersama kami</p>
        <a href="#kontak" class="bg-primary px-6 py-2 rounded-lg hover:bg-teal-700">
            Hubungi Kami
        </a>
    </div>
</section>

<!-- Tentang -->
<section id="tentang" class="py-16 bg-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-6">Tentang Perumahan</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">
            <?= $nama_perumahan; ?> merupakan kawasan hunian modern di Jember 
            dengan konsep minimalis, lingkungan hijau, serta akses strategis 
            menuju pusat kota dan fasilitas umum.
        </p>
    </div>
</section>

<!-- Fasilitas -->
<section id="fasilitas" class="py-16 bg-gray-100">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-10">Fasilitas Unggulan</h2>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg">
                <h3 class="font-bold text-xl mb-2">Keamanan 24 Jam</h3>
                <p class="text-gray-600">Sistem keamanan terpadu dengan penjagaan penuh.</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg">
                <h3 class="font-bold text-xl mb-2">Lingkungan Asri</h3>
                <p class="text-gray-600">Taman hijau dan udara segar untuk keluarga.</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg">
                <h3 class="font-bold text-xl mb-2">Lokasi Strategis</h3>
                <p class="text-gray-600">Dekat sekolah, pasar, dan pusat kota.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section id="kontak" class="py-16 bg-primary text-white text-center">
    <h2 class="text-3xl font-bold mb-4">Segera Miliki Hunian Impian Anda</h2>
    <p class="mb-6">Hubungi kami sekarang untuk info lebih lanjut</p>
    <a href="#" class="bg-white text-primary px-6 py-2 rounded-lg hover:bg-gray-200">
        Hubungi Kami
    </a>
</section>

<!-- Footer -->
<footer class="bg-gray-800 text-white text-center py-4">
    <p>&copy; <?= date("Y"); ?> <?= $nama_perumahan; ?>. All Rights Reserved.</p>
</footer>

</body>
</html>
