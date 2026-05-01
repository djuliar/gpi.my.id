<?php
$nama_perumahan = "Graha Permata Indah Jember";
$tagline = "Hunian Elegan untuk Kehidupan Berkualitas";
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $nama_perumahan; ?></title>

<script src="https://cdn.tailwindcss.com"></script>

<!-- Font aesthetic -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    body { font-family: 'Poppins', sans-serif; }
</style>

<script>
tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: '#1f2937',
                accent: '#c6a96b'
            }
        }
    }
}
</script>

</head>

<body class="bg-gray-50 text-gray-800">

<!-- Navbar -->
<header class="fixed w-full z-50 backdrop-blur-md bg-white/70 shadow-sm">
    <div class="max-w-7xl mx-auto flex justify-between items-center p-4">
        <h1 class="font-semibold tracking-wide"><?= $nama_perumahan; ?></h1>
        <nav class="space-x-6 text-sm">
            <a href="#" class="hover:text-accent transition">Home</a>
            <a href="#tentang" class="hover:text-accent transition">Tentang</a>
            <a href="#fasilitas" class="hover:text-accent transition">Fasilitas</a>
            <a href="#kontak" class="hover:text-accent transition">Kontak</a>
        </nav>
    </div>
</header>

<!-- Hero -->
<section class="h-screen flex items-center justify-center relative">

    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c"
         class="absolute w-full h-full object-cover" />

    <div class="absolute inset-0 bg-black/40"></div>

    <div class="relative text-center text-white px-6">
        <h2 class="text-5xl md:text-6xl font-light leading-tight mb-6">
            <?= $tagline; ?>
        </h2>
        <p class="mb-8 text-lg opacity-90">
            Desain modern, lingkungan eksklusif, dan lokasi strategis di Jember
        </p>

        <a href="#kontak"
           class="px-8 py-3 border border-white rounded-full hover:bg-white hover:text-black transition">
           Konsultasi Sekarang
        </a>
    </div>
</section>

<!-- Tentang -->
<section id="tentang" class="py-24 bg-white">
    <div class="max-w-4xl mx-auto text-center px-6">
        <h2 class="text-3xl font-semibold mb-6">Tentang Perumahan</h2>
        <p class="text-gray-600 leading-relaxed">
            <?= $nama_perumahan; ?> menghadirkan konsep hunian modern dengan sentuhan elegan.
            Dirancang untuk memberikan kenyamanan maksimal dengan lingkungan hijau,
            keamanan terjamin, serta akses mudah ke berbagai fasilitas kota.
        </p>
    </div>
</section>

<!-- Fasilitas -->
<section id="fasilitas" class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-3xl font-semibold text-center mb-16">Fasilitas Premium</h2>

        <div class="grid md:grid-cols-3 gap-10">

            <div class="p-8 rounded-2xl bg-white shadow-md hover:shadow-xl transition">
                <h3 class="text-xl font-semibold mb-3">Keamanan 24 Jam</h3>
                <p class="text-gray-600">Sistem keamanan modern dengan pengawasan penuh.</p>
            </div>

            <div class="p-8 rounded-2xl bg-white shadow-md hover:shadow-xl transition">
                <h3 class="text-xl font-semibold mb-3">Lingkungan Hijau</h3>
                <p class="text-gray-600">Area taman luas dan udara yang segar.</p>
            </div>

            <div class="p-8 rounded-2xl bg-white shadow-md hover:shadow-xl transition">
                <h3 class="text-xl font-semibold mb-3">Akses Strategis</h3>
                <p class="text-gray-600">Dekat pusat kota, sekolah, dan fasilitas umum.</p>
            </div>

        </div>
    </div>
</section>

<!-- Highlight Image -->
<section class="py-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="rounded-3xl overflow-hidden shadow-lg">
            <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994"
                 class="w-full h-[400px] object-cover">
        </div>
    </div>
</section>

<!-- CTA -->
<section id="kontak" class="py-24 bg-primary text-white text-center">
    <h2 class="text-3xl font-light mb-4">Miliki Hunian Impian Anda</h2>
    <p class="mb-8 opacity-80">Hubungi kami untuk informasi dan survey lokasi</p>

    <a href="#"
       class="bg-accent text-black px-8 py-3 rounded-full hover:opacity-90 transition">
       Hubungi Marketing
    </a>
</section>

<!-- Footer -->
<footer class="bg-black text-gray-400 text-center py-6 text-sm">
    <p>&copy; <?= date("Y"); ?> <?= $nama_perumahan; ?>. All rights reserved.</p>
</footer>

</body>
</html>            <a href="#tentang" class="hover:underline">Tentang</a>
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
