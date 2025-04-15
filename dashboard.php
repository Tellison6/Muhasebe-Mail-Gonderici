<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Borç Sistemi Ana Sayfa</title>
  <link href="src/output.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

  <!-- Header -->
  <header class="bg-white shadow-md p-5 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a1 1 0 001 1h16a1 1 0 001-1V7M3 7l9 6 9-6" />
      </svg>
      Borç Sistemi Ana Sayfa
    </h1>
    <a href="logout.php" class="text-red-500 font-medium hover:underline">Çıkış Yap</a>
  </header>

  <!-- İçerik -->
  <main class="flex-grow flex items-center justify-center p-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 w-full max-w-5xl">

      <!-- Mail Gönder -->
      <a href="dashboard_gonder.php" class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition duration-300 text-center group">
        <div class="flex justify-center mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m0 0v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8m18 0L12 13 3 8" />
          </svg>
        </div>
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Borç Bildirimi Gönder</h2>
        <p class="text-gray-600 text-sm">Müşteri seç, borç tutarını gir, şablonla mail gönder.</p>
      </a>

      <!-- Müşteri Yönetimi -->
      <a href="musteri_yonetim.php" class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition duration-300 text-center group">
        <div class="flex justify-center mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-purple-600 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h5m6-10a4 4 0 100-8 4 4 0 000 8z" />
          </svg>
        </div>
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Müşteri Oluştur</h2>
        <p class="text-gray-600 text-sm">Yeni müşteri bilgisi girin, listeyi düzenleyin.</p>
      </a>

    </div>
  </main>

</body>
</html>
