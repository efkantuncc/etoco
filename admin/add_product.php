<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO products (name, image_url, description, price, purchase_link) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['name'],
        $_POST['image_url'],
        $_POST['description'],
        $_POST['price'],
        $_POST['purchase_link']
    ]);
    $success = "Ürün eklendi!";
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ürün Ekle | Zenthor</title>
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body class="admin-body">
    <div class="admin-header"><h1>Ürün Ekle</h1></div>
    <div class="admin-menu">
        <a href="dashboard.php">Panel</a>
        <a href="manage_products.php">Ürünleri Yönet</a>
    </div>
    <div class="admin-content">
        <?php if (isset($success)) echo "<p>$success</p>"; ?>
        <form method="POST">
            <input type="text" name="name" placeholder="Ürün Adı" required><br>
            <input type="text" name="image_url" placeholder="Görsel URL" required><br>
            <textarea name="description" placeholder="Açıklama" required></textarea><br>
            <input type="number" step="0.01" name="price" placeholder="Fiyat" required><br>
            <input type="text" name="purchase_link" placeholder="Satın Alma Linki" required><br>
            <button type="submit">Ürünü Ekle</button>
        </form>
    </div>
</body>
</html>
