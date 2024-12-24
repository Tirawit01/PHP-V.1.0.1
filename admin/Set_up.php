<?php
// เชื่อมต่อฐานข้อมูล
include '../Check.php'; // ตรวจสอบการเข้าสู่ระบบ
include('../config.php'); // ไฟล์เชื่อมต่อฐานข้อมูล

// โหลดค่าปัจจุบันจากฐานข้อมูล
$sql = "SELECT * FROM settings LIMIT 1";
$stmt = $pdo->query($sql);
$currentSettings = $stmt->fetch(PDO::FETCH_ASSOC);

// อัปเดตข้อมูลเมื่อฟอร์มถูกส่ง
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $site_name = $_POST['site_name'] ?? '';
    $site_color = $_POST['site_color'] ?? '';
    $text_color = $_POST['textColor'] ?? '';
    $map = $_POST['map'] ?? ''; // รับค่าจากฟอร์ม

    // การจัดการการอัปโหลดไฟล์โลโก้
    if (isset($_FILES['additionalText2']) && $_FILES['additionalText2']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
  
        $fileName = time() . '_' . basename($_FILES['additionalText2']['name']);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
  
        if (in_array($fileExtension, $allowedExtensions)) {
            $filePath = $uploadDir . $fileName;
            if (move_uploaded_file($_FILES['additionalText2']['tmp_name'], $filePath)) {
                $logo_url = $filePath;
            } else {
                echo "<script>alert('ไม่สามารถอัปโหลดไฟล์โลโก้ได้');</script>";
            }
        } else {
            echo "<script>alert('รูปแบบไฟล์โลโก้ไม่ถูกต้อง');</script>";
        }
    }

    // การจัดการการอัปโหลดไฟล์แบรนเนอร์
    $banners = [];
    for ($i = 1; $i <= 3; $i++) {
        $bannerField = 'banner_' . $i;
        $bannerUrl = $currentSettings[$bannerField] ?? '';
        if (isset($_FILES[$bannerField]) && $_FILES[$bannerField]['error'] === UPLOAD_ERR_OK) {
            $fileName = basename($_FILES[$bannerField]['name']);
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($fileExtension, $allowedExtensions)) {
                $filePath = $uploadDir . $fileName;
                if (move_uploaded_file($_FILES[$bannerField]['tmp_name'], $filePath)) {
                    $bannerUrl = $filePath;
                } else {
                    echo "<script>alert('ไม่สามารถอัปโหลดไฟล์แบรนเนอร์ {$i} ได้');</script>";
                }
            } else {
                echo "<script>alert('รูปแบบไฟล์แบรนเนอร์ {$i} ไม่ถูกต้อง. อนุญาตเฉพาะ .jpg, .jpeg, .png, หรือ .gif');</script>";
            }
        }
        $banners[$bannerField] = $bannerUrl;
    }

    // อัปเดตข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO settings (id, site_name, logo_url, site_color, text_color, map, banner_1, banner_2, banner_3) 
            VALUES (1, :site_name, :logo_url, :site_color, :text_color, :map, :banner_1, :banner_2, :banner_3)
            ON DUPLICATE KEY UPDATE 
            site_name = :site_name, 
            logo_url = :logo_url, 
            site_color = :site_color, 
            text_color = :text_color, 
            map = :map, 
            banner_1 = :banner_1, 
            banner_2 = :banner_2, 
            banner_3 = :banner_3";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':site_name', $site_name);
    $stmt->bindParam(':logo_url', $logo_url);
    $stmt->bindParam(':site_color', $site_color);
    $stmt->bindParam(':text_color', $text_color);
    $stmt->bindParam(':map', $map);
    $stmt->bindParam(':banner_1', $banners['banner_1']);
    $stmt->bindParam(':banner_2', $banners['banner_2']);
    $stmt->bindParam(':banner_3', $banners['banner_3']);

    if ($stmt->execute()) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
        $currentSettings = array_merge([
            'site_name' => $site_name,
            'logo_url' => $logo_url,
            'site_color' => $site_color,
            'text_color' => $text_color,
            'map' => $map,
        ], $banners);
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');</script>";
    }
}
?>



<!DOCTYPE php>
<php lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="icon"
      href="https://cdn.discordapp.com/attachments/1093611863897559211/1154797217375322132/364806853_1025807301934485_544726315995811807_n.jpg?ex=653298b7&is=652023b7&hm=6dc2bd4092041f058d60232252def4b9ad488aa44a1e23d70cfb2e6f280015d5&">
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      integrity="sha512-..." crossorigin="anonymous" />
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
  </head>

  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="/img/logo.jpg" alt="AdminLTELogo" height="60" width="60">
      </div>

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php" class="nav-link">หน้าหลัก</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="/admin/Set_up.php" class="nav-link">ตั้งค่าเว็ปไซต์</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="/admin/member.php" class="nav-link">จัดการสมาชิก</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="/admin/product.php" class="nav-link">เพิ่มข้อมูล</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="/admin/edit_week.php" class="nav-link">จัดการหมวดหมู่</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
              <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
              <form class="form-inline">
                <div class="input-group input-group-sm">
                  <input class="form-control form-control-navbar" type="search" placeholder="Search"
                    aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li>

          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <a href="#" class="dropdown-item">
                <div class="media">
                  <img src="/SHOP/images/application.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Brad Diesel
                      <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">Call me whenever you can...</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <div class="media">
                  <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      John Pierce
                      <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">I got your message bro</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <div class="media">
                  <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Nora Silvester
                      <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">The subject goes here</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
        </ul>
      </nav>

      <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: rgb(37, 36, 39);">
        <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="/img/logo.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">Admin</a>
            </div>
          </div>

          <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
            </div>
          </div>

          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/Set_up.php" class="nav-link">
                  <i class="nav-icon fas fa-cogs"></i>
                  <p>
                    ตั้งค่าเว็ปไซต์ 1
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/profile.php" class="nav-link">
                  <i class="nav-icon fas fa-cogs"></i>
                  <p>
                    ตั้งค่าเว็ปไซต์ 2
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/member.php" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    จัดการสมาชิก
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/product.php" class="nav-link">
                  <i class="nav-icon fas fa-box"></i>
                  <p>
                    เพิ่มข้อมูล
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-th-list"></i>
                  <p>
                    จัดการหมวดหมู่
                  </p>
                </a>
              </li>

            </ul>
          </nav>
        </div>
      </aside>

      <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">ตั้งค่าเว็ปไซต์</h1>
              </div>
            </div>
          </div>
        </div>

        <section class="content">
          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <!-- เพิ่มส่วนของฟอร์มตั้งค่าสีและพื้นหลัง -->
              <div class="color-settings-form card">
                <div class="card-header">
                  ตั้งค่าสีและพื้นหลัง
                </div>
                <div class="card-body">
                  <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="site_name">ชื่อเว็ปไซต์</label>
                      <input type="text" id="site_name" name="site_name" class="form-control"
                        value="<?= htmlspecialchars($currentSettings['site_name'] ?? '') ?>"
                        placeholder="กรอกชื่อเว็ปไซต์">
                    </div>
                    <div class="form-group">
                      <label for="additionalText2">โลโก้เว็ปไซต์</label>
                      <input type="file" id="additionalText2" name="additionalText2" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="banner_1">แบรนเนอร์ 1</label>
                      <input type="file" id="banner_1" name="banner_1" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="banner_2">แบรนเนอร์ 2</label>
                      <input type="file" id="banner_2" name="banner_2" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="banner_3">แบรนเนอร์ 3</label>
                      <input type="file" id="banner_3" name="banner_3" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="map">แมพ</label>
                      <input type="url" id="map" name="map" class="form-control"
                        value="<?php echo htmlspecialchars($currentSettings['map'] ?? ''); ?>">
                    </div>

                    <div class="form-group">
                      <label for="site_color">สีพื้นหลัง Navbar</label>
                      <input type="color" id="site_color" name="site_color" class="form-control"
                        value="<?= htmlspecialchars($currentSettings['site_color'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                      <label for="textColor">สีข้อความ Navbar</label>
                      <input type="color" id="textColor" name="textColor" class="form-control"
                        value="<?= htmlspecialchars($currentSettings['text_color'] ?? '') ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                  </form>
                </div>
              </div>
            </div>
          </section>
        </section>
      </div>

      <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
          Anything you want
        </div>
        <strong>Copyright &copy; 2024 <a href="#">Your Company</a>.</strong> All rights reserved.
      </footer>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="dist/js/adminlte.js"></script>
  </body>

</php>