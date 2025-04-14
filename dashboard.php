<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
  exit;
}

// Yeni müşteri ekle
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_customer'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $stmt = $pdo->prepare("INSERT INTO customers (name, email) VALUES (?, ?)");
  $stmt->execute([$name, $email]);
  header("Location: dashboard.php");
  exit;
}

// Müşteri listesi
$customers = $pdo->query("SELECT * FROM customers ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link href="tailwind.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">

  <div class="bg-white shadow p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold">📋 Müşteri Paneli</h1>
    <a href="logout.php" class="text-red-500 hover:underline">Çıkış Yap</a>
  </div>

  <div class="p-6 max-w-4xl mx-auto">
    <div class="bg-white p-6 rounded shadow mb-6">
      <h2 class="text-lg font-bold mb-4">➕ Yeni Müşteri Ekle</h2>
      <form method="post">
        <input type="hidden" name="add_customer" value="1">
        <div class="flex gap-4 mb-4">
          <input name="name" type="text" placeholder="Müşteri Adı" class="w-1/2 p-2 border rounded" required>
          <input name="email" type="email" placeholder="E-posta" class="w-1/2 p-2 border rounded" required>
        </div>
        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Ekle</button>
      </form>
    </div>

    <div class="bg-white p-6 rounded shadow">
      <h2 class="text-lg font-bold mb-4">📧 Borç Bildirimi Gönder</h2>
      <form action="mail_send.php" method="post">
        <div class="mb-4">
          <label class="block font-semibold mb-1">Müşteri Seç</label>
          <select name="customer_id" class="w-full p-2 border rounded" required>
            <option value="">-- Seçin --</option>
            <?php foreach ($customers as $c): ?>
              <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?> - <?= $c['email'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-4">
          <label class="block font-semibold mb-1">Borç Tutarı</label>
          <input name="amount" type="text" placeholder="Örn: 15.000,44 TL" class="w-full p-2 border rounded" required>
        </div>

        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
          Mail Gönder
        </button>
      </form>
    </div>
  </div>
</body>
</html>
