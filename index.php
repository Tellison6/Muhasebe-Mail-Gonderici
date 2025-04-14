<?php include 'db.php'; session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <link href="src/input.css" rel="stylesheet">
  <link href="src/output.css" rel="stylesheet">
  <title>Giriş Yap</title>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
  <form action="login_check.php" method="post" class="bg-white p-8 rounded shadow-md w-96">
    <h2 class="text-2xl font-bold mb-6 text-center">Giriş Yap</h2>
    <input name="username" type="text" placeholder="Kullanıcı Adı" class="w-full mb-4 p-2 border rounded" required>
    <input name="password" type="password" placeholder="Şifre" class="w-full mb-4 p-2 border rounded" required>
    <button class="w-full bg-blue-600 text-white p-2 rounded">Giriş</button>
  </form>
</body>
</html>
