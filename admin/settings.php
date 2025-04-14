<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("UPDATE settings SET site_title=?, maintenance_mode=? WHERE id=1");
    $stmt->execute([
        $_POST['site_title'],
        isset($_POST['maintenance_mode']) ? 1 : 0
    ]);
    header("Location: settings.php");
}

$settings = $conn->query("SELECT * FROM settings LIMIT 1")->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Site Ayarları | Zenthor</title>
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body class="admin-body">
    <div class="admin-header"><h1>Site Ayarları</h1></div>
    <div class="admin-menu">
        <a href="dashboard.php">Panel</a>
    </div>
    <div class="admin-content">
        <form method="POST">
            <input type="text" name="site_title" value="<?= $settings['site_title'] ?>" required><br>
            <label><input type="checkbox" name="maintenance_mode" <?= $settings['maintenance_mode'] ? 'checked' : '' ?>> Bakım Modu Aktif</label><br>
            <button type="submit">Kaydet</button>
        </form>
    </div>
</body>
</html>
