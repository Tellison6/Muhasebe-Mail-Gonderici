<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
  exit;
}

// Müşteri listesi
$customers = $pdo->query("SELECT * FROM customers ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Borç Bildirimi Gönder</title>
  <link href="src/output.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

  <!-- Header -->
  <header class="bg-white shadow p-5 flex justify-between items-center">
    <h1 class="text-xl font-bold text-gray-800 flex items-center gap-2">
      📧 Borç Bildirimi Gönder
    </h1>
    <a href="dashboard.php" class="text-blue-600 hover:underline">← Ana Sayfa</a>
  </header>

  <!-- Form Kartı -->
  <main class="flex-grow flex items-center justify-center p-6">
    <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-xl">
      <form action="mail_send.php" method="POST" class="space-y-6">
        <!-- Müşteri Seçimi -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Müşteri Seç</label>
          <select name="customer_id" required class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300">
            <option value="">-- Müşteri Seçin --</option>
            <?php foreach ($customers as $c): ?>
              <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?> - <?= $c['email'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Borç Tutarı -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Borç Tutarı</label>
          <input type="text" name="amount" placeholder="Örn: 12.500,00 TL" required class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300">
        </div>

        <!-- Gönder Butonu -->
        <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-md hover:bg-red-700 transition">
          📤 Mail Gönder
        </button>
      </form>
    </div>
  </main>

</body>
</html>
