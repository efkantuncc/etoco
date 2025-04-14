<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
require '../config.php';

if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header("Location: manage_products.php");
}

$products = $conn->query("SELECT * FROM products ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ürünleri Yönet | Zenthor</title>
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body class="admin-body">
    <div class="admin-header"><h1>Ürünleri Yönet</h1></div>
    <div class="admin-menu">
        <a href="dashboard.php">Panel</a>
        <a href="add_product.php">Ürün Ekle</a>
    </div>
    <div class="admin-content">
        <?php foreach ($products as $p): ?>
            <div style="margin-bottom: 20px; border-bottom: 1px solid #444;">
                <h3><?= $p['name'] ?></h3>
                <img src="<?= $p['image_url'] ?>" alt="" style="width: 100px;"><br>
                <p><?= $p['description'] ?></p>
                <p>Fiyat: <?= number_format($p['price'], 2) ?> TL</p>
                <a href="?delete=<?= $p['id'] ?>" onclick="return confirm('Silmek istediğine emin misin?')">Sil</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
