<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO announcements (message, is_discount) VALUES (?, ?)");
    $stmt->execute([$_POST['message'], isset($_POST['is_discount']) ? 1 : 0]);
}

if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM announcements WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header("Location: announcements.php");
}

$announcements = $conn->query("SELECT * FROM announcements ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Duyurular | Zenthor</title>
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body class="admin-body">
    <div class="admin-header"><h1>Duyuru / İndirim</h1></div>
    <div class="admin-menu">
        <a href="dashboard.php">Panel</a>
    </div>
    <div class="admin-content">
        <form method="POST">
            <textarea name="message" placeholder="Duyuru / indirim mesajı" required></textarea><br>
            <label><input type="checkbox" name="is_discount"> Bu bir indirim mi?</label><br>
            <button type="submit">Ekle</button>
        </form>
        <hr>
        <?php foreach ($announcements as $a): ?>
            <div>
                <p><?= $a['message'] ?> <?= $a['is_discount'] ? '(İndirim)' : '' ?></p>
                <a href="?delete=<?= $a['id'] ?>">Sil</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
