<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tirawit";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบว่ามี ID ส่งมาหรือไม่
if (isset($_GET['id'])) {   
    $id = $_GET['id'];

    // คำสั่ง SQL สำหรับลบข้อมูล
    $sql = "DELETE FROM users WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "ลบข้อมูลสำเร็จ!";
    } else {
        echo "เกิดข้อผิดพลาด: " . $conn->error;
    }
}

// ปิดการเชื่อมต่อ
$conn->close();

// กลับไปที่หน้าแสดงผลงาน
header("Location: index.php");
exit();
?>
