<?php
session_start();

if (!isset($_SESSION['npm'])) {
    header('Location: login.php');
    exit();
}

$host = "localhost:3306";
$username = "uash7276_rahma";
$password = "rahma123";
$database = "uash7276_mhs_dj_rahma";

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

$npm = $_SESSION['npm'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE npm = ?");
$stmt->execute([$npm]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

<div>
    <h2>Simulasi Halaman Admin</h2>
    
    <a href="logout.php">Logout</a>
    <p>Menu-menu admin ada di sini.</p>
</div>

</body>
</html>