<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
require '../config.php';

// Site ayarlarını çek
$site = $conn->query("SELECT * FROM settings LIMIT 1")->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Zenthor Admin Panel</title>
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body class="admin-body">
    <div class="admin-header">
        <h1>Zenthor Yönetim Paneli</h1>
        <p>Merhaba, <?= $_SESSION['admin'] ?></p>
    </div>
    <div class="admin-menu">
        <a href="add_product.php">Ürün Ekle</a>
        <a href="manage_products.php">Ürünleri Yönet</a>
        <a href="announcements.php">Duyuru / İndirim</a>
        <a href="settings.php">Site Ayarları</a>
        <a href="logout.php">Çıkış</a>
    </div>
    <div class="admin-content">
        <p>Site Başlığı: <?= $site['site_title'] ?></p>
        <p>Bakım Modu: <?= $site['maintenance_mode'] ? "Açık" : "Kapalı" ?></p>
    </div>
</body>
</html>
