<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "الرجاء إدخال البريد وكلمة المرور"]);
        exit;
    }

    // البحث عن المستخدم
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // التحقق من وجود المستخدم ومن صحة كلمة المرور المشفرة
    if ($user && password_verify($password, $user['password'])) {
        // حفظ بيانات المستخدم في الجلسة (Session)
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        
        echo json_encode(["status" => "success", "message" => "تم تسجيل الدخول"]);
    } else {
        echo json_encode(["status" => "error", "message" => "البريد الإلكتروني أو كلمة المرور غير صحيحة"]);
    }
}
?>