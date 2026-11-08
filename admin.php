<?php
// استدعاء ملف الاتصال بقاعدة البيانات
require_once 'db.php';

// جلب البيانات من قاعدة البيانات
$users = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
$messages = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
$jobs = $pdo->query("SELECT * FROM jobs")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - مهنتي</title>
    <style>
        /* تصميم سريع ومريح للعين للجداول */
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; margin: 0; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; }
        h1 { text-align: center; color: #333; margin-bottom: 40px; }
        h2 { color: #007bff; margin-top: 40px; border-bottom: 2px solid #007bff; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px; }
        th, td { padding: 12px 15px; border: 1px solid #ddd; text-align: right; }
        th { background-color: #007bff; color: white; font-weight: bold; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        tr:hover { background-color: #f1f1f1; }
        .no-data { text-align: center; color: #777; padding: 20px; }
    </style>
</head>
<body>

    <div class="container">
        <h1>📊 لوحة تحكم تطبيق مهنتي</h1>

        <!-- جدول المستخدمين -->
        <h2>👥 المستخدمون المسجلون (<?php echo count($users); ?>)</h2>
        <table>
            <thead>
                <tr>
                    <th>الرقم</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($users) > 0): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="3" class="no-data">لا يوجد مستخدمون حتى الآن</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- جدول الرسائل -->
        <h2>📩 رسائل التواصل (<?php echo count($messages); ?>)</h2>
        <table>
            <thead>
                <tr>
                    <th>الرقم</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الرسالة</th>
                    <th>التاريخ</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($messages) > 0): ?>
                    <?php foreach ($messages as $msg): ?>
                        <tr>
                            <td><?= htmlspecialchars($msg['id']) ?></td>
                            <td><?= htmlspecialchars($msg['name']) ?></td>
                            <td><?= htmlspecialchars($msg['email']) ?></td>
                            <td><?= htmlspecialchars($msg['message']) ?></td>
                            <td style="direction: ltr; text-align: right;"><?= htmlspecialchars($msg['created_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="no-data">لا توجد رسائل حتى الآن</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- جدول الوظائف -->
        <h2>💼 الوظائف المنشورة (<?php echo count($jobs); ?>)</h2>
        <table>
            <thead>
                <tr>
                    <th>الرقم</th>
                    <th>المسمى الوظيفي</th>
                    <th>الشركة</th>
                    <th>المدينة</th>
                    <th>نوع الدوام</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($jobs) > 0): ?>
                    <?php foreach ($jobs as $job): ?>
                        <tr>
                            <td><?= htmlspecialchars($job['id']) ?></td>
                            <td><?= htmlspecialchars($job['title']) ?></td>
                            <td><?= htmlspecialchars($job['company']) ?></td>
                            <td><?= htmlspecialchars($job['location']) ?></td>
                            <td><?= htmlspecialchars($job['type']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="no-data">لا توجد وظائف حتى الآن</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>