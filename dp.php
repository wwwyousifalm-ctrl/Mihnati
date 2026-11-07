<?php
$host = 'localhost';
$dbname = 'mihnati_db';
$username = 'root'; // اسم المستخدم الافتراضي في XAMPP
$password = ''; // كلمة المرور الافتراضية فارغة

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // إعداد وضع الأخطاء لعرضها
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
}
?>