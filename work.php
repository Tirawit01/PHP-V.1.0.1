<?php

// เชื่อมต่อฐานข้อมูล

require 'config.php'; // ใช้ไฟล์ config สำหรับการเชื่อมต่อ PDO



try {

    // ดึงข้อมูลทั้งหมดจากตาราง settings

    $stmt = $pdo->prepare("SELECT * FROM settings WHERE id = 1 LIMIT 1");

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);



    // ตรวจสอบว่ามีผลลัพธ์หรือไม่

    if ($result) {

        // กำหนดค่าตัวแปรจากฐานข้อมูล

        $site_name = $result['site_name'] ?? 'Default Site Name';

        $logo_url = $result['logo_url'] ?? 'uploads/default_logo.png';

        $site_color = $result['site_color'] ?? '#ffffff';

        $text_color = $result['text_color'] ?? '#000000';

        $map = $result['map'] ?? 'map';

    } else {

        // ใช้ค่าเริ่มต้นหากไม่มีข้อมูลในตาราง

        $site_name = 'Default Site Name';

        $logo_url = 'uploads/default_logo.png';

        $site_color = '#ffffff';

        $text_color = '#000000';

        $banner_1 = 'uploads/default_banner1.jpg';

        $banner_2 = 'uploads/default_banner2.jpg';

        $banner_3 = 'uploads/default_banner3.jpg';

        $map = $result['map'] ?? 'map';

    }

} catch (PDOException $e) {

    // แสดงข้อความข้อผิดพลาด

    die("Error: " . $e->getMessage());

}

?>



<!DOCTYPE html>

<html lang="en">



<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php echo htmlspecialchars($site_name); ?> | บันทึกการฝึกงาน</title>

  <link rel="icon" href="<?php echo htmlspecialchars($logo_url); ?>">

  <!-- import Google Fonts -->

  <link rel="preconnect" href="https://fonts.googleapis.com">

  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link

    href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai+Looped:wght@100;200;300;400;500;600;700;800;900&family=Playwrite+HR:wght@100..400&display=swap"

    rel="stylesheet">

  <!-- Bootstrap CSS -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- style -->

  <link rel="stylesheet" href="work.css">

  <link rel="stylesheet" href="fade-in.css">

  <!-- Font Awesome CDN -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!--script -->

  <script src="script.js"></script>

  <script src="loading.js"></script>

  <!-- SEO -->

  <meta property="og:locale" content="th_TH" />

  <meta property="og:type" content="website" />

  <meta property="og:title" content=" TIRAWIT | TIRAWIT SUKKHAO" />

  <meta name="description" content="เว็บไซต์บันทึกการฝึกงานของ TIRAWIT ที่ให้ข้อมูลเกี่ยวกับการฝึกงานและการติดต่อ">

  <meta name="keywords" content="ฝึกงาน, TIRAWIT, บันทึกการฝึกงาน, ติดต่อ">

  <style>

  :root {

    --primary-color: <?php echo htmlspecialchars($text_color); ?>;

    --secondary-color: #6c757d;

    --navbar-bg: <?php echo htmlspecialchars($site_color); ?>;

    --navbar-text:  <?php echo htmlspecialchars($text_color); ?>;

    --carousel-indicator-active: #ffffff;

    --color-bg:#fcfcfc;

    --text:#fcfcfc;

  }

</style>

</head>



<body>



  <div class="snowflakes" aria-hidden="true">

		<div class="snowflake">

			<div class="inner">❅</div>

		</div>

		<div class="snowflake">

			<div class="inner">❅</div>

		</div>

		<div class="snowflake">

			<div class="inner">❅</div>

		</div>

		<div class="snowflake">

			<div class="inner">❅</div>

		</div>

		<div class="snowflake">

			<div class="inner">❅</div>

		</div>

		<div class="snowflake">

			<div class="inner">❅</div>

		</div>

		<div class="snowflake">

			<div class="inner">❅</div>

		</div>

		<div class="snowflake">

			<div class="inner">❅</div>

		</div>

		<div class="snowflake">

			<div class="inner">❅</div>

		</div>

		<div class="snowflake">

			<div class="inner">❅</div>

		</div>

		<div class="snowflake">

			<div class="inner">❅</div>

		</div>

		<div class="snowflake">

			<div class="inner">❅</div>

		</div>

	</div>



  <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light">

    <div class="container-fluid">

      <a class="navbar-brand" href="index.php">

        <img src="<?php echo htmlspecialchars($logo_url); ?>" alt="หน้าหลัก" width="50" height="50">

      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"

        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">

        <span class="navbar-toggler-icon"></span>

      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link active" href="index.php"><i class="fas fa-home"></i> หน้าหลัก</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="History.php"><i class="fas fa-user"></i> ประวัติ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="work.php"><i class="fas fa-briefcase"></i> การฝึกงาน</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="objective.php"><i class="fas fa-bullseye"></i>
                จุดประสงค์</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="view.php"><i class="fa-solid fa-film"></i> บรรยากาศ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://web.facebook.com/tirawit.tirawit"><i class="fa-brands fa-facebook"></i></i>
                </i> ติดต่อ</a>
            </li>
          </ul>
          <a class="navbar-brand" href="login.php" aria-label="Go to homepage"><i class="fas fa-sign-in-alt"></i>
            ล็อกอิน</a>
        </div>
      </div>

  </nav>



  <main>

    <div class="container mt-5">

        <h1 class="gallery-title">การฝึกงาน</h1>

        <div class="row">

            <?php

            include 'config.php'; // เชื่อมต่อกับฐานข้อมูล



            // ดึงข้อมูลจากตาราง BOX

            $query = $pdo->query("SELECT * FROM box ORDER BY week_number");

            $internships = $query->fetchAll();



            // ตรวจสอบว่ามีข้อมูลในตารางหรือไม่

            if (count($internships) == 0) {

                echo "<p>ไม่มีรายการที่จะโชว์</p>";

            } else {

                // แสดงข้อมูลแต่ละสัปดาห์

                foreach ($internships as $internship) {

                    echo '<div class="col-12 week-section">';

                    echo '<h2 class="week-title">Week ' . $internship['week_number'] . '</h2>';

                    echo '<div class="row g-3">';

                    

                    // นับจำนวนรูปภาพที่แสดง

                    $imageCount = 0;



                    // แสดงภาพ 3 ภาพสำหรับแต่ละสัปดาห์

                    for ($i = 1; $i <= 3; $i++) {

                        $imageUrl = $internship['image_url_' . $i];

                        // ตรวจสอบว่ามี URL ของภาพหรือไม่

                        if (!empty($imageUrl)) {

                            echo '<div class="col-md-4">';

                            echo '<img src="' . $imageUrl . '" class="img-fluid" alt="Week ' . $internship['week_number'] . ' Image ' . $i . '">';

                            echo '</div>';

                            $imageCount++;

                        }

                    }



                    // ตรวจสอบว่ามีรูปภาพไม่ถึง 3 รูปภาพ

                    if ($imageCount < 3) {

                        echo '<div class="col-md-4">';

                        echo '<p class="text-center">ไม่มีรูปภาพเพิ่มเติม</p>';

                        echo '</div>';

                    }



                    echo '</div>';

                    echo '<div class="form-group mt-4 text-center">';

                    echo '<label class="note-label">รายละเอียด</label>';

                    echo '<p class="note-text">' . $internship['description'] . '</p>';

                    echo '</div>';

                    echo '</div>';

                }

            }

            ?>

        </div>

    </div>

</main>







  <footer class="py-3">

    <ul class="nav justify-content-center border-bottom pb-3 mb-3">

      <li class="nav-item"><a href="#" class="nav-link px-2 text-light">หน้าหลัก</a></li>

      <li class="nav-item"><a href="#" class="nav-link px-2 text-light">เกี่ยวกับ</a></li>

      <li class="nav-item"><a href="#" class="nav-link px-2 text-light">การฝึกงาน</a></li>

      <li class="nav-item"><a href="#" class="nav-link px-2 text-light">จุดประสงค์</a></li>

      <li class="nav-item"><a href="#" class="nav-link px-2 text-light">ติดต่อ</a></li>

    </ul>

    <p class="text-center text-light">ยินดีต้อนรับเข้าสู่ เว็ปบันทึกการฝึกงาน<br>หากเจอปัญหาการใช้งาน ติดต่อ เฟส :

      TIRAWI</p>



    <div class="container d-flex justify-content-between align-items-center">

      <div class="col-lg-6">

        <img class="logo" src="<?php echo htmlspecialchars($logo_url); ?>" alt="Logo">

      </div>

      <div class="col-lg-6 map-container">

        <iframe

          src="<?php echo htmlspecialchars($map); ?>"

          width="500" height="350" style="border:0;" allowfullscreen="" loading="lazy"

          referrerpolicy="no-referrer-when-downgrade"></iframe>

      </div>

    </div>

  </footer>

  <!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</body>



</html>