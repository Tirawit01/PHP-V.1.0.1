<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $week_number = $_POST['week_number'];
    $description = $_POST['description'];
    
    $image_urls = [];
    for ($i = 1; $i <= 3; $i++) {
        if (isset($_FILES["image_url_$i"]) && $_FILES["image_url_$i"]["error"] == 0) {
            $target_dir = "../uploads/"; // โฟลเดอร์สำหรับเก็บไฟล์
            $target_file = $target_dir . basename($_FILES["image_url_$i"]["name"]);
            move_uploaded_file($_FILES["image_url_$i"]["tmp_name"], $target_file);
            $image_urls[] = $target_file; // เก็บ URL ของไฟล์ภาพ
        }
    }

    // สร้าง SQL Query
    $sql = "INSERT INTO box (week_number, description, image_url_1, image_url_2, image_url_3) VALUES (:week_number, :description, :image_url_1, :image_url_2, :image_url_3)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':week_number', $week_number);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image_url_1', $image_urls[0]);
    $stmt->bindParam(':image_url_2', $image_urls[1]);
    $stmt->bindParam(':image_url_3', $image_urls[2]);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'เพิ่มข้อมูลสำเร็จ']);
    } else {
        echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการเพิ่มข้อมูล']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ไม่สามารถเข้าถึงได้']);
}
?>
