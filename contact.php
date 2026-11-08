<?php
// استدعاء ملف الاتصال بقاعدة البيانات
require_once 'db.php';

// تحديد أن الرد سيكون بصيغة JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // استقبال البيانات المرسلة من الجافا سكريبت
    $data = json_decode(file_get_contents("php://input"), true);
    
    $name = trim($data['name'] ?? '');
    $email = trim($data['email'] ?? '');
    $message = trim($data['message'] ?? '');

    // التحقق من أن جميع الحقول غير فارغة
    if (empty($name) || empty($email) || empty($message)) {
        echo json_encode(["status" => "error", "message" => "الرجاء ملء جميع الحقول المطلوبة."]);
        exit;
    }

    // التحقق من صحة صيغة البريد الإلكتروني
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "البريد الإلكتروني غير صالح."]);
        exit;
    }

    try {
        // إدخال الرسالة في قاعدة البيانات
        $stmt = $pdo->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $message]);
        
        echo json_encode(["status" => "success", "message" => "تم إرسال رسالتك بنجاح! سنتواصل معك قريباً."]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "عذراً، حدث خطأ أثناء إرسال الرسالة. حاول لاحقاً."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "طريقة طلب غير صالحة."]);
}
?>