<?php
session_start();         // Oturumu başlat
session_unset();         // Tüm oturum değişkenlerini temizle
session_destroy();       // Oturumu sonlandır
header("Location: index.php"); // Giriş ekranına yönlendir
exit;
