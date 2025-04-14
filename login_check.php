<?php
include 'db.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
  $_SESSION['user'] = $user;
  header("Location: dashboard.php");
} else {
  echo "Hatalı giriş. <a href='index.php'>Geri dön</a>";
}
