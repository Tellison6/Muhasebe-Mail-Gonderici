<?php
$pdo = new PDO("mysql:host=localhost;dbname=muhasebe;charset=utf8", "kullanici", "sifre");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
