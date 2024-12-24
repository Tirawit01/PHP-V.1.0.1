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

        $map = $result['map'] ?? '';

    } else {

        // ใช้ค่าเริ่มต้นหากไม่มีข้อมูลในตาราง

        $site_name = 'Default Site Name';

        $logo_url = 'uploads/default_logo.png';

        $site_color = '#ffffff';

        $text_color = '#000000';

        $banner_1 = 'uploads/default_banner1.jpg';

        $banner_2 = 'uploads/default_banner2.jpg';

        $banner_3 = 'uploads/default_banner3.jpg';

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

  <title><?php echo htmlspecialchars($site_name); ?> | จุดประสงค์</title>

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



  <main>

    <main class="container">

      <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">

        <div class="col-lg-6 px-0">

          <h1 class="display-4 fst-italic">การฝึกงาน: ประสบการณ์ที่เปลี่ยนชีวิต</h1>

          <p class="lead my-3">การฝึกงานเป็นโอกาสที่ดีในการเรียนรู้และพัฒนาทักษะในสาขาที่เราสนใจ

            ซึ่งช่วยให้เราเตรียมตัวเข้าสู่ตลาดแรงงานได้ดียิ่งขึ้น</p>

          <p class="lead mb-0"><a href="#" class="text-body-emphasis fw-bold">อ่านต่อ...</a></p>

        </div>

      </div>



      <div class="row mb-2">

        <div class="col-md-6">

          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">

            <div class="col p-4 d-flex flex-column position-static">

              <strong class="d-inline-block mb-2 text-primary-emphasis">ประสบการณ์</strong>

              <h3 class="mb-0">การฝึกงานที่ มหาวิทยาลัยราชภัฏ นครศรีธรรมราช</h3>

              <div class="mb-1 text-body-secondary">พฤษภาคม 10</div>

              <p class="card-text mb-auto">

                การฝึกงานที่นี่ให้โอกาสในการเรียนรู้จากผู้เชี่ยวชาญในวงการและทำงานในโปรเจกต์จริง</p>

              <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">

                อ่านต่อ

                <svg class="bi">

                  <use xlink:href="#chevron-right" />

                </svg>

              </a>

            </div>

            <div class="col-auto d-none d-lg-block">

              <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img"

                aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">

                <title>Placeholder</title>

                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"

                  dy=".3em">ภาพตัวอย่าง</text>

              </svg>

            </div>

          </div>

        </div>

        <div class="col-md-6">

          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">

            <div class="col p-4 d-flex flex-column position-static">

              <strong class="d-inline-block mb-2 text-success-emphasis">ทักษะที่ได้เรียนรู้</strong>

              <h3 class="mb-0">ทักษะที่พัฒนาขึ้น</h3>

              <div class="mb-1 text-body-secondary">พฤษภาคม 9</div>

              <p class="mb-auto">ในระหว่างการฝึกงาน ฉันได้เรียนรู้ทักษะใหม่ ๆ และพัฒนาความสามารถในการทำงานร่วมกับผู้อื่น

              </p>

              <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">

                อ่านต่อ

                <svg class="bi">

                  <use xlink:href="#chevron-right" />

                </svg>

              </a>

            </div>

            <div class="col-auto d-none d-lg-block">

              <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img"

                aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">

                <title>Placeholder</title>

                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"

                  dy=".3em">ภาพตัวอย่าง</text>

              </svg>

            </div>

          </div>

        </div>

      </div>



      <div class="row g-5">

        <div class="col-md-8">

          <h3 class="pb-4 mb-4 fst-italic border-bottom">

            ประสบการณ์จากการฝึกงาน

          </h3>



          <article class="blog-post">

            <h2 class="display-5 link-body-emphasis mb-1">บันทึกการฝึกงาน</h2>

            <p class="blog-post-meta">มกราคม 1, 2024 โดย <a href="#">นักศึกษา</a></p>



            <p>การฝึกงานที่มหาวิทยาลัยราชภัฏ นครศรีธรรมราช เป็นประสบการณ์ที่สำคัญมาก

              ฉันได้ทำงานในโครงการที่ท้าทายและได้รับคำแนะนำจากผู้เชี่ยวชาญที่มีประสบการณ์</p>

            <hr>

            <p>ในการฝึกงานนี้ ฉันได้เรียนรู้เกี่ยวกับการทำงานเป็นทีม การสื่อสารที่มีประสิทธิภาพ และการจัดการเวลา

              ซึ่งทั้งหมดนี้เป็นทักษะที่มีคุณค่าในตลาดงาน</p>

            <h2>บทเรียนที่ได้รับ</h2>

            <p>การฝึกงานสอนให้ฉันรู้ว่าความมุ่งมั่นและการทำงานหนักจะนำไปสู่ผลลัพธ์ที่ดี:</p>

            <blockquote class="blockquote">

              <p>“การเรียนรู้ไม่ได้จบลงแค่ในห้องเรียน แต่ยังเกิดขึ้นในที่ทำงานจริง”</p>

            </blockquote>

            <p>ประสบการณ์นี้ทำให้ฉันมั่นใจในอนาคตของฉันมากขึ้น</p>

            <h3>การทำงานเป็นทีม</h3>

            <p>การทำงานร่วมกับเพื่อนร่วมงานทำให้ฉันเข้าใจถึงความสำคัญของการสื่อสารและการประสานงาน:</p>

            <ul>

              <li>การแลกเปลี่ยนความคิดเห็น</li>

              <li>การสนับสนุนซึ่งกันและกัน</li>

              <li>การแก้ไขปัญหาร่วมกัน</li>

            </ul>

            <h2>ทักษะที่พัฒนาขึ้น</h2>

            <p>ในระหว่างการฝึกงาน ฉันได้พัฒนาทักษะต่าง ๆ เช่น:</p>

            <ol>

              <li>การใช้โปรแกรมซอฟต์แวร์เฉพาะทาง</li>

              <li>การวิเคราะห์ข้อมูล</li>

              <li>การนำเสนอผลงานอย่างมืออาชีพ</li>

            </ol>

            <p>ทั้งหมดนี้ทำให้ฉันพร้อมมากขึ้นในการเข้าสู่ตลาดแรงงาน</p>

          </article>



          <nav class="blog-pagination" aria-label="Pagination">

            <a class="btn btn-outline-primary rounded-pill" href="#">โพสต์ก่อนหน้า</a>

            <a class="btn btn-outline-secondary rounded-pill disabled" aria-disabled="true">โพสต์ถัดไป</a>

          </nav>



        </div>



        <div class="col-md-4">

          <div class="position-sticky" style="top: 2rem;">

            <div class="p-4 mb-3 bg-body-tertiary rounded">

              <h4 class="fst-italic">เกี่ยวกับการฝึกงาน</h4>

              <p class="mb-0">การฝึกงานคือโอกาสที่ทำให้เราสามารถเรียนรู้ทักษะใหม่ ๆ

                และสร้างประสบการณ์ที่มีค่าก่อนเข้าสู่ตลาดแรงงาน</p>

            </div>



            <div>

            <?php

// เรียกข้อมูลโพสต์ล่าสุดจากฐานข้อมูล

$stmt = $pdo->prepare("SELECT * FROM box ORDER BY week_number DESC LIMIT 1");

$stmt->execute();

$post = $stmt->fetch(PDO::FETCH_ASSOC);

?>



<h4 class="fst-italic">โพสต์ล่าสุด</h4>

<ul class="list-unstyled">

  <?php if ($post): ?>

  <li>

    <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top"

      href="#">

      <img src="<?= htmlspecialchars($post['image_url_1']) ?>"

        alt="Image for <?= htmlspecialchars($post['description']) ?>" width="400" height="250"

        class="bd-placeholder-img">

      <div class="col-lg-8">

        <small class="text-body-secondary">สัปดาห์ที่

          <?= htmlspecialchars($post['week_number']) ?>

        </small>

        <h6 class="mb-0">

          <?= htmlspecialchars($post['description']) ?>

        </h6>

      </div>

    </a>

  </li>

  <?php else: ?>

  <li class="text-muted">ไม่มีโพสต์ที่จะแสดง</li>

  <?php endif; ?>

</ul>



    </main>

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

  <!-- Bootstrap JS -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</body>



</html>