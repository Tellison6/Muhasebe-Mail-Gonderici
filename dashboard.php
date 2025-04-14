<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
  exit;
}

$customers = $pdo->query("SELECT * FROM customers ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>📬 Borç Bildirimi</title>
  <link href="src/input.css" rel="stylesheet">
  <link href="src/output.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">

  <!-- Header -->
  <header class="bg-white shadow-sm p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold text-gray-800">📬 Borç Bildirimi Paneli</h1>
    <div class="space-x-4">
      <a href="musteri_yonetim.php" class="text-blue-600 hover:underline">Müşteri Yönetimi</a>
      <a href="logout.php" class="text-red-500 hover:underline">Çıkış Yap</a>
    </div>
  </header>

  <!-- Ana Kart -->
  <main class="max-w-2xl mx-auto mt-10">
    <div class="bg-white rounded-xl shadow-lg p-8">
      <h2 class="text-2xl font-semibold mb-6 text-gray-700 flex items-center gap-2">
        💼 Borç Bildirimi Gönder
      </h2>

      <form action="mail_send.php" method="POST" class="space-y-5">
        <!-- Müşteri Seçimi -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Müşteri Seç</label>
          <select name="customer_id" required class="w-full p-3 border rounded-md bg-white shadow-sm focus:outline-blue-500">
            <option value="">-- Müşteri Seçin --</option>
            <?php foreach ($customers as $c): ?>
              <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?> - <?= $c['email'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Borç Tutarı -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Borç Tutarı</label>
          <input type="text" name="amount" required placeholder="Örn: 12.500,00 TL" class="w-full p-3 border rounded-md shadow-sm focus:outline-blue-500">
        </div>

        <!-- Gönder Butonu -->
        <button type="submit" class="w-full bg-red-600 text-white font-medium py-3 rounded-md hover:bg-red-700 transition">
          📤 Mail Gönder
        </button>
      </form>
    </div>
  </main>

</body>
</html>
