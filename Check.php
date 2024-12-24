<?php
session_start();
include('config.php'); // ตรวจสอบว่า config.php มีการตั้งค่า PDO connection

// ตรวจสอบว่า session username มีค่าหรือไม่
if (!isset($_SESSION['username'])) {
    header("location: ../login.php");
    exit(); // หยุดการทำงานหลัง redirect
}

// ตรวจสอบว่ามีคำขอออกจากระบบหรือไม่
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ../login.php");
    exit(); // หยุดการทำงานหลัง redirect
}

// ใช้ prepared statement เพื่อป้องกัน SQL Injection
$username = $_SESSION['username'];
$query = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$query->bindParam(':username', $username, PDO::PARAM_STR);
$query->execute();
$user = $query->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found.";
    exit();
}

// สามารถนำข้อมูลผู้ใช้ไปใช้งานต่อได้ในโค้ดส่วนอื่น
?>
