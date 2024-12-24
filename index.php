<!--

  ██╗  ██╗ ██████╗ ██╗  ██╗ ██████╗     ███████╗██╗  ██╗ ██████╗ ██████╗ 

  ██║ ██╔╝██╔═══██╗██║ ██╔╝██╔═══██╗    ██╔════╝██║  ██║██╔═══██╗██╔══██╗

  █████╔╝ ██║   ██║█████╔╝ ██║   ██║    ███████╗███████║██║   ██║██████╔╝

  ██╔═██╗ ██║   ██║██╔═██╗ ██║   ██║    ╚════██║██╔══██║██║   ██║██╔═══╝ 

  ██║  ██╗╚██████╔╝██║  ██╗╚██████╔╝    ███████║██║  ██║╚██████╔╝██║     

  ╚═╝  ╚═╝ ╚═════╝ ╚═╝  ╚═╝ ╚═════╝     ╚══════╝╚═╝  ╚═╝ ╚═════╝ ╚═╝    

-->



<!--จ้ะเอ๋ตัวเองงงงดูโค๊ดเค้าอ่อ-->























<!----สวัสดีน่าาาาาาาา---->































<!----ชื่อไรเอ๋ยยยยยยย---->

























<!-- อย่าพึ่งท้อสิ-->

















































<!-- ลงไปอีกนิดนึงนะ-> 





























































<!-- อีกนิํดดดดด-->





































































































<?php

// เชื่อมต่อฐานข้อมูล

require 'config.php'; // ใช้ไฟล์ config สำหรับการเชื่อมต่อ PDO



try {

    // ดึงข้อมูลทั้งหมดจากตาราง settings

    $stmt = $pdo->prepare("SELECT id, site_name, logo_url, site_color, text_color, banner_1, banner_2, banner_3, map FROM settings WHERE id = 1 LIMIT 1");

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);



      // ดึงข้อมูลเฉพาะคอลัมน์ logo จากตาราง profile

      $stmt_profile = $pdo->prepare("SELECT logo FROM profile WHERE logo = logo LIMIT 1"); // สมมุติว่า `user_id` เป็นตัวระบุผู้ใช้

      $stmt_profile->execute();

      $result_profile = $stmt_profile->fetch(PDO::FETCH_ASSOC);

  

      // ตรวจสอบว่ามีผลลัพธ์หรือไม่

      if ($result_profile) {

          // ดึงค่า logo จากผลลัพธ์

          $logo_url = $result_profile['logo'] ?? 'default_logo.png'; // กำหนดค่าเริ่มต้นหากไม่มี logo

      } else {

          // หากไม่มีข้อมูลในตาราง profile

          $logo_url = 'default_logo.png'; // ค่าเริ่มต้น

      }



    // ตรวจสอบว่ามีผลลัพธ์หรือไม่

    if ($result) {

        // กำหนดค่าตัวแปรจากฐานข้อมูล

        $site_name = $result['site_name'] ?? 'Default Site Name';

        $logo_url = $result['logo_url'] ?? 'uploads/default_logo.png';

        $site_color = $result['site_color'] ?? '#ffffff';

        $text_color = $result['text_color'] ?? '#000000';

        $banner_1 = $result['banner_1'] ?? 'uploads/default_banner1.jpg';

        $banner_2 = $result['banner_2'] ?? 'uploads/default_banner2.jpg';

        $banner_3 = $result['banner_3'] ?? 'uploads/default_banner3.jpg';

        $map = $result['map'] ?? 'default_map_url'; // กำหนดค่าเริ่มต้นสำหรับ map

    } else {

        // ใช้ค่าเริ่มต้นหากไม่มีข้อมูลในตาราง

        $site_name = 'Default Site Name';

        $logo_url = 'uploads/default_logo.png';

        $site_color = '#ffffff';

        $text_color = '#000000';

        $banner_1 = 'uploads/default_banner1.jpg';

        $banner_2 = 'uploads/default_banner2.jpg';

        $banner_3 = 'uploads/default_banner3.jpg';

        $map = 'default_map_url';

    }

} catch (PDOException $e) {

    // แสดงข้อความข้อผิดพลาด

    die("Error: " . $e->getMessage());

}

?>

<!---ถึงแย้วววววววววววววววววววววววววว-->

<!DOCTYPE php>

<php lang="en">



<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php echo htmlspecialchars($site_name); ?> | หน้าหลัก</title>

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

  <link rel="stylesheet" href="style.css">

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



  <section>

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">

      <div class="carousel-indicators">

        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"

          aria-current="true" aria-label="Slide 1"></button>

        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"

          aria-label="Slide 2"></button>

        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"

          aria-label="Slide 3"></button>

      </div>

      <?php

// สมมติว่ามีการเชื่อมต่อฐานข้อมูลเรียบร้อยแล้ว และดึงข้อมูลแบรนเนอร์จากฐานข้อมูล

$query = "SELECT banner_1, banner_2, banner_3 FROM settings";

$result = $pdo->query($query);

$banners = $result->fetch(PDO::FETCH_ASSOC);

?>



<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

    <div class="carousel-inner">

        <?php

        // ตรวจสอบว่าแบนเนอร์มีค่าและวนลูปแสดงผล

        $activeClass = "active";

        foreach ($banners as $key => $banner) {

            if (!empty($banner)) {

                echo '<div class="carousel-item ' . $activeClass . '">';

                echo '<img src="' . htmlspecialchars($banner) . '" class="d-block w-100" alt="' . htmlspecialchars($key) . '">';

                echo '</div>';

                $activeClass = ""; // หลังจากแสดง active ครั้งแรกให้ลบออก

            }

        }

        ?>

    </div>



    <!-- ปุ่มสำหรับเลื่อน Carousel -->

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">

        <span class="carousel-control-prev-icon" aria-hidden="true"></span>

        <span class="visually-hidden">Previous</span>

    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">

        <span class="carousel-control-next-icon" aria-hidden="true"></span>

        <span class="visually-hidden">Next</span>

    </button>

</div>

      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"

        data-bs-slide="prev">

        <span class="carousel-control-prev-icon" aria-hidden="true"></span>

        <span class="visually-hidden">Previous</span>

      </button>

      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"

        data-bs-slide="next">

        <span class="carousel-control-next-icon" aria-hidden="true"></span>

        <span class="visually-hidden">Next</span>

      </button>

    </div>

  </section>





  <main>

    <section class="hero-section text-center py-5">

      <div class="container">

        <h1 class="display-4">ยินดีต้อนรับสู่การฝึกงานที่ มหาวิทยาลัยราชภัฏ</h1>

        <p class="lead">เรามุ่งมั่นในการให้บริการที่ดีที่สุด</p>

        <a href="#" class="btn btn-primary btn-lg">เรียนรู้เพิ่มเติม</a>

      </div>

    </section>



    <section class="internship-details py-5">

      <div class="container">

        <h2 class="text-center mb-4">ประสบการณ์ฝึกงานของผม</h2>

        <div class="row">

          <div class="col-md-12">

            <h5>การฝึกงานด้านเทคโนโลยีสารสนเทศที่ มหาวิทยาลัยราชภัฏนครศรีธรรมราช</h5>

            <p>ผมเป็นนักศึกษาฝึกงานด้านเทคโนโลยีสารสนเทศที่มหาวิทยาลัยราชภัฏนครศรีธรรมราช 

               ระหว่างการฝึกงาน ผมได้มีโอกาสเรียนรู้และพัฒนาทักษะด้าน IT ผ่านการทำงานในโครงการจริง 

               ซึ่งเน้นการพัฒนาและจัดการระบบสารสนเทศ รวมถึงการทำงานร่วมกับผู้เชี่ยวชาญในสาขา 

               เพื่อเตรียมความพร้อมสำหรับการทำงานในอนาคต</p>

            <ul>

              <li>ระยะเวลา: 1 ปี (เริ่มตั้งแต่เดือนตุลาคมถึงเดือนมกราคม)</li>

              <li>สถานที่: คณะวิทยาการและเทคโนโลยีสารสนเทศ, มหาวิทยาลัยราชภัฏนครศรีธรรมราช</li>

            </ul>

          </div>

        </div>

      </div>

    </section>    

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

    width="500" height="350" style="border:0;" allowfullscreen=""

    loading="lazy" referrerpolicy="no-referrer-when-downgrade">

</iframe>



      </div>

    </div>

  </footer>

  <!-- Bootstrap JS -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>



  <!-- Bootstrap JS -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</body>



</php>