<?php
require 'config.php';

$settings = $conn->query("SELECT * FROM settings LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$products = $conn->query("SELECT * FROM products ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
$announcement = $conn->query("SELECT * FROM announcements ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);

if ($settings['maintenance_mode']) {
    header("Location: maintenance.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title><?= $settings['site_title'] ?> | Zenthor</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <div class="navbar">
        <h1><?= htmlspecialchars($settings['site_title']) ?></h1>
    </div>

    <div class="container">
        <div class="hero">
            <h2>Kalite, Zarafet ve Zenthor</h2>
            <p>Premium ürünleri keşfedin. Güvenilir alışveriş deneyimi burada.</p>
        </div>

        <?php if ($announcement): ?>
            <div class="announcement">
                <strong>Duyuru:</strong> <?= htmlspecialchars($announcement['content']) ?>
            </div>
        <?php endif; ?>

        <div class="products">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    <div class="card-body">
                        <h3><?= htmlspecialchars($product['name']) ?></h3>
                        <p><?= htmlspecialchars(mb_strimwidth($product['description'], 0, 60, '...')) ?></p>
                        <div class="price"><?= number_format($product['price'], 2) ?> TL</div>
                        <a href="product.php?id=<?= $product['id'] ?>" class="btn">İncele</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>
</html>
