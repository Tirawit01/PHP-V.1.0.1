<?php
// เชื่อมต่อกับฐานข้อมูล
require_once 'config.php';

try {
    // เตรียมคำสั่ง SQL
    $stmt = $pdo->prepare("SELECT logo_url FROM settings LIMIT 1");
    $stmt->execute();

    // ดึงผลลัพธ์
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // ตรวจสอบว่ามีค่า logo_url หรือไม่
    $logo_url = $result['logo_url'] ?? ''; // ใช้ ?? เพื่อกำหนดค่าเริ่มต้นเป็นว่าง หากไม่มี logo_url
} catch (PDOException $e) {
    echo "ข้อผิดพลาด: " . $e->getMessage();
    $logo_url = ''; // กำหนดค่า logo_url เป็นว่าง หากเกิดข้อผิดพลาด
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading</title>
    <link rel="icon" type="image/png" href="https://media.discordapp.net/attachments/1292356178818371725/1292444613839421531/44729.webp?ex=6703c258&is=670270d8&hm=9fefa7bf0e2e7aeeb851fd8c20e1e471da908aea8f04ffdbc50fd132afc99637&=&format=webp&width=960&height=421">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <script src="loading.js"></script>
    <style>
        body {
            font-family: 'Noto Sans Thai', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #000000;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }
        .loader-container {
            text-align: center;
        }
        .logo {
            width: 150px; /* ปรับขนาดโลโก้ตามต้องการ */
            margin-bottom: 20px;
            animation: float 2s ease-in-out infinite; /* เพิ่มการเคลื่อนไหว */
        }
        .loader {
            border: 16px solid #f3f3f3; /* สีพื้นหลังของวงกลม */
            border-top: 16px solid #d60d0d; /* สีของส่วนที่หมุน */
            border-radius: 50%;
            width: 60px; /* ขนาดวงกลม */
            height: 60px; /* ขนาดวงกลม */
            animation: spin 2s linear infinite; /* การหมุน */
            margin: 20px auto; /* จัดกลาง */
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        p {
            font-size: 20px;
            color: #fcfcfc;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="loader-container">
        <!-- ตรวจสอบว่ามีโลโก้ให้แสดง -->
        <?php if (!empty($logo_url)): ?>
            <img src="<?php echo htmlspecialchars($logo_url); ?>" alt="โลโก้" class="logo">
        <?php else: ?>
            <p>ไม่พบโลโก้</p>
        <?php endif; ?>
        <div class="loader"></div>
        <p>กำลังโหลดข้อมูล...</p>
    </div>
</body>
</html>
