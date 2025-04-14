<?php
require 'config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Ürün bulunamadı.";
    exit;
}

$settings = $conn->query("SELECT * FROM settings LIMIT 1")->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['name']) ?> | <?= $settings['site_title'] ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="navbar">
        <div class="container">
            <h1><a href="index.php"><?= $settings['site_title'] ?></a></h1>
        </div>
    </div>

    <div class="container">
        <div class="product-detail">
            <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
            <div class="product-info">
                <h2><?= htmlspecialchars($product['name']) ?></h2>
                <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                <p class="price"><?= number_format($product['price'], 2) ?> TL</p>
                <a href="<?= htmlspecialchars($product['purchase_link']) ?>" target="_blank" class="buy-btn">Satın Al</a>
            </div>
        </div>
    </div>
</body>
</html>
