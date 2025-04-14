<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
include 'db.php';
session_start();

// Güvenlik kontrolü
if (!isset($_SESSION['user']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
  header("Location: index.php");
  exit;
}

$customer_id = $_POST['customer_id'];
$amount = $_POST['amount'];

$stmt = $pdo->prepare("SELECT * FROM customers WHERE id = ?");
$stmt->execute([$customer_id]);
$customer = $stmt->fetch();

if (!$customer) {
  echo "Müşteri bulunamadı.";
  exit;
}

$name = $customer['name'];
$email = $customer['email'];


// ✉️ HTML Mail içeriği
$html = file_get_contents('mail_template.html');
$html = str_replace(['${name}', '${amount}'], [$name, $amount], $html);

$mail = new PHPMailer(true);
try {
  $mail->isSMTP();
  $mail->Host       = 'ms4.guzel.net.tr'; // sunucuna göre değiştir
  $mail->SMTPAuth   = true;
  $mail->Username   = 'muhasebe@medicom.net.tr';
  $mail->Password   = '2P3poluVfK';
  $mail->SMTPSecure = 'ssl';
  $mail->Port       = 465;

  $mail->CharSet = 'UTF-8';
  $mail->Encoding = 'base64';

  $mail->setFrom('muhasebe@medicom.net.tr', 'Medicom Bilişim');
  $mail->addAddress($email, $name);

  $mail->isHTML(true);
  $mail->Subject = '📌 Ödeme Hatırlatma';
  $mail->Body    = $html;

  $mail->send();
  echo "<script>alert('Mail başarıyla gönderildi'); window.location.href='dashboard.php';</script>";
} catch (Exception $e) {
  echo "Mail gönderilemedi: {$mail->ErrorInfo}";
}
