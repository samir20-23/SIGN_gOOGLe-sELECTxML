<?php
// معلومات الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "SAMIR";
$password = "samir123";
$dbname = "booking";

try {
    // إنشاء اتصال PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // التحقق من صحة المدخلات
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        // استخدام المعاملات المحضرة
        $stmt = $conn->prepare("SELECT tour_price FROM tour WHERE tour_id = :id");
        $stmt->bindParam(':id', $id , PDO::PARAM_INT);
        $stmt->execute();

        // جلب النتيجة
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // إعداد الاستجابة بصيغة JSON
            echo json_encode(['price' => $result['tour_price']]);
        } else {
            echo json_encode(['error' => 'No results found']);
        }
    } else {
        echo json_encode(['error' => 'Invalid input']);
    }
} catch(PDOException $e) {
    echo json_encode(['error' => 'Connection failed: ' . $e->getMessage()]);
}

// إغلاق الاتصال
$conn = null;
?>
