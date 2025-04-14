<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
  exit;
}

// Müşteri ekleme
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_customer'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $stmt = $pdo->prepare("INSERT INTO customers (name, email) VALUES (?, ?)");
  $stmt->execute([$name, $email]);
  header("Location: musteri_yonetim.php");
  exit;
}

// Müşteri silme
if (isset($_GET['sil'])) {
  $id = $_GET['sil'];
  $stmt = $pdo->prepare("DELETE FROM customers WHERE id = ?");
  $stmt->execute([$id]);
  header("Location: musteri_yonetim.php");
  exit;
}

$customers = $pdo->query("SELECT * FROM customers ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Müşteri Yönetimi</title>
  <link href="src/input.css" rel="stylesheet">
  <link href="src/output.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen p-6">

  <div class="max-w-5xl mx-auto">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-gray-800">👥 Müşteri Yönetimi</h1>
      <a href="dashboard.php" class="text-blue-600 hover:underline">← Panele Dön</a>
    </div>

    <!-- Müşteri Ekleme Formu -->
    <div class="bg-white p-6 rounded-lg shadow mb-8">
      <h2 class="text-xl font-semibold mb-4">➕ Yeni Müşteri Ekle</h2>
      <form method="post" class="flex flex-col md:flex-row gap-4">
        <input type="hidden" name="add_customer" value="1">
        <input name="name" type="text" placeholder="Ad Soyad" required class="p-3 border rounded w-full">
        <input name="email" type="email" placeholder="E-posta" required class="p-3 border rounded w-full">
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded w-full md:w-auto">
          Ekle
        </button>
      </form>
    </div>

    <!-- Müşteri Listesi -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ($customers as $c): ?>
        <div class="bg-white p-5 rounded-lg shadow relative">
          <h3 class="text-lg font-bold text-gray-800 mb-1"><?= htmlspecialchars($c['name']) ?></h3>
          <p class="text-gray-600 text-sm mb-3"><?= htmlspecialchars($c['email']) ?></p>
          <a href="?sil=<?= $c['id'] ?>" onclick="return confirm('Silmek istediğinize emin misiniz?')" class="absolute top-3 right-3 text-red-500 hover:text-red-700">
            ✖
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

</body>
</html>
