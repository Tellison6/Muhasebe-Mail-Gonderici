<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
require 'db.php';

session_start();
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
  exit;
}

// Form verisi
$customer_id = $_POST['customer_id'] ?? null;
$amount = $_POST['amount'] ?? null;

if (!$customer_id || !$amount) {
  die("Eksik bilgi.");
}

// Müşteri bilgisi çek
$stmt = $pdo->prepare("SELECT * FROM customers WHERE id = ?");
$stmt->execute([$customer_id]);
$customer = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$customer) {
  die("Müşteri bulunamadı.");
}

// HTML şablon yükle
$template = file_get_contents('mail_template.html');

// Değişkenleri yerleştir
$html = str_replace(
  ['${name}', '${amount}'],
  [htmlspecialchars($customer['name']), htmlspecialchars($amount)],
  $template
);

// PHPMailer ile gönderim
$mail = new PHPMailer(true);

try {
  $mail->isSMTP();
  $mail->Host = 'ms4.guzel.net.tr';       // 🔁 Buraya SMTP bilgilerin gelecek
  $mail->SMTPAuth = true;
  $mail->Username = 'muhasebe@medicom.net.tr';     // 🔁 Gönderen e-posta
  $mail->Password = '2P3poluVfK';              // 🔁 Şifre
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465;

  $mail->CharSet = 'UTF-8';
  $mail->Encoding = 'base64';

  $mail->setFrom('muhasebe@medicom.net.tr', 'Medicom Bilişim'); // Gönderen
  $mail->addAddress($customer['email'], $customer['name']); // Alıcı

  $mail->isHTML(true);
  $mail->Subject = '📌 Ödeme Hatırlatması';
  $mail->Body    = $html;

  $mail->send();
  header("Location: dashboard_gonder.php?status=success");
} catch (Exception $e) {
  echo "Mail gönderilemedi. Hata: {$mail->ErrorInfo}";
}
