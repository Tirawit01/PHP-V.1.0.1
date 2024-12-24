<?php
// การเชื่อมต่อฐานข้อมูล
include '../config.php'; 

// ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT id, week_number, description, image_url_1, image_url_2, image_url_3 FROM BOX";
$result = $pdo->query($sql);

// การเตรียมข้อมูลให้เป็น JSON
$data = [];
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}

// ส่งข้อมูลเป็น JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
