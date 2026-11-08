<?php
$host = 'sql103.infinityfree.com';
$dbname = 'if0_43384761_mihnati3';
$username = 'if0_43384761';
$password = 'DffyvoJEuudA'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
}
?>