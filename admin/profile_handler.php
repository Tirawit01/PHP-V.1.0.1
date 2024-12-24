<?php
include('../config.php'); // เชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจากฟอร์ม
    $name = $_POST['name'];
    $age = $_POST['age'];
    $education = $_POST['education'] ?? null;
    $address = $_POST['address'] ?? null;
    $province = $_POST['province'] ?? null;
    $website = $_POST['website'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $email = $_POST['email'] ?? null;

    // ตั้งค่าผลลัพธ์สำหรับโลโก้
    $logo_path = null; 

    // อัปโหลดโลโก้ถ้ามีการเลือกไฟล์
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $logo_tmp_name = $_FILES['logo']['tmp_name'];
        $logo_name = basename($_FILES['logo']['name']);
        $logo_path = '../uploads/' . $logo_name; // เพิ่ม '/' ระหว่างโฟลเดอร์และชื่อไฟล์

        // ย้ายไฟล์ไปยังโฟลเดอร์ uploads
        if (!move_uploaded_file($logo_tmp_name, $logo_path)) {
            echo "<script>alert('เกิดข้อผิดพลาดในการอัปโหลดโลโก้'); window.location.href = 'profile.php';</script>";
            exit;
        }
    }

    // ตรวจสอบว่าอีเมลนี้มีในฐานข้อมูลหรือไม่
    $sql_check_email = "SELECT id, logo FROM profile WHERE email = :email";
    $stmt_check = $pdo->prepare($sql_check_email);
    $stmt_check->execute([':email' => $email]);
    $existing_profile = $stmt_check->fetch();

    if ($existing_profile) {
        // อัปเดตข้อมูลผู้ใช้ในกรณีที่มีอีเมลในฐานข้อมูล
        $sql_update = "UPDATE profile 
                       SET name = :name, age = :age, education = :education, address = :address, 
                           province = :province, website = :website, phone = :phone, logo = :logo
                       WHERE email = :email";

        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute([
            ':name' => $name,
            ':age' => $age,
            ':education' => $education,
            ':address' => $address,
            ':province' => $province,
            ':website' => $website,
            ':phone' => $phone,
            ':email' => $email,
            ':logo' => $logo_path ?? $existing_profile['logo'], // ใช้โลโก้เก่าหากไม่มีการอัปโหลดใหม่
        ]);

        // แจ้งผลลัพธ์
        echo "<script>alert('ข้อมูลได้รับการอัปเดตเรียบร้อย!'); window.location.href = 'profile.php';</script>";
    } else {
        // ถ้าไม่มีอีเมลในฐานข้อมูล ทำการบันทึกข้อมูลใหม่
        $sql_insert = "INSERT INTO profile (name, age, education, address, province, website, phone, email, logo) 
                       VALUES (:name, :age, :education, :address, :province, :website, :phone, :email, :logo)";

        $stmt_insert = $pdo->prepare($sql_insert);
        $stmt_insert->execute([
            ':name' => $name,
            ':age' => $age,
            ':education' => $education,
            ':address' => $address,
            ':province' => $province,
            ':website' => $website,
            ':phone' => $phone,
            ':email' => $email,
            ':logo' => $logo_path, // อัปเดตโลโก้ถ้ามีการอัปโหลดใหม่
        ]);

        // แจ้งผลลัพธ์
        echo "<script>alert('ข้อมูลถูกบันทึกเรียบร้อย!'); window.location.href = 'profile.php';</script>";
    }
}
?>
