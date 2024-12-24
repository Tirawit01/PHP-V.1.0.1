<?php

// แสดงข้อผิดพลาด

error_reporting(E_ALL);

ini_set('display_errors', 1);

include '../Check.php'; // Check login

// รวมไฟล์การเชื่อมต่อฐานข้อมูล

include '../config.php';



// ดึงข้อมูลทั้งหมดจากตาราง box

$stmt = $pdo->query('SELECT * FROM box');

$boxes = $stmt->fetchAll(PDO::FETCH_ASSOC);



// ตรวจสอบการอัปเดต

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {

    $id = $_POST['id'];

    $week_number = $_POST['week_number'];

    $description = $_POST['description'];



    // เก็บเส้นทางไฟล์รูปภาพ

    $image_url_1 = null;

    $image_url_2 = null;

    $image_url_3 = null;



    // ฟังก์ชันสำหรับการอัปโหลดไฟล์

    function uploadImage($file, $targetDir = '../uploads/') {

        if ($file['error'] === UPLOAD_ERR_OK) {

            $filename = basename($file['name']);

            $targetFilePath = $targetDir . $filename;

            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {

                return $targetFilePath;

            }

        }

        return null;

    }



    // ตรวจสอบและอัปโหลดรูปภาพทีละไฟล์

    if (!empty($_FILES['image_url_1']['name'])) {

        $image_url_1 = uploadImage($_FILES['image_url_1']);

    }

    if (!empty($_FILES['image_url_2']['name'])) {

        $image_url_2 = uploadImage($_FILES['image_url_2']);

    }

    if (!empty($_FILES['image_url_3']['name'])) {

        $image_url_3 = uploadImage($_FILES['image_url_3']);

    }



    // ตรวจสอบว่า id ไม่เป็นค่าว่าง

    if (!empty($id)) {

        // อัปเดตข้อมูลในฐานข้อมูล

        $updateStmt = $pdo->prepare("UPDATE box SET week_number = ?, description = ?, image_url_1 = COALESCE(?, image_url_1), image_url_2 = COALESCE(?, image_url_2), image_url_3 = COALESCE(?, image_url_3) WHERE id = ?");

        if ($updateStmt->execute([$week_number, $description, $image_url_1, $image_url_2, $image_url_3, $id])) {

            // แสดงข้อความเมื่ออัปเดตสำเร็จ

            echo "<script>alert('ข้อมูลถูกอัปเดตเรียบร้อย');</script>";

        } else {

            // แสดงข้อความเมื่อเกิดข้อผิดพลาด

            echo "<script>alert('เกิดข้อผิดพลาดในการอัปเดต');</script>";

        }

    }

}

?>



<!DOCTYPE html>

<html lang="en">



<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Admin</title>

  <link rel="icon"

    href="https://cdn.discordapp.com/attachments/1093611863897559211/1154797217375322132/364806853_1025807301934485_544726315995811807_n.jpg?ex=653298b7&is=652023b7&hm=6dc2bd4092041f058d60232252def4b9ad488aa44a1e23d70cfb2e6f280015d5&">

  <!-- Google Font: Source Sans Pro -->

  <link rel="stylesheet"

    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"

    integrity="sha512-..." crossorigin="anonymous" />

  <!-- Tempusdominus Bootstrap 4 -->

  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <!-- iCheck -->

  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- JQVMap -->

  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <!-- overlayScrollbars -->

  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <!-- Daterange picker -->

  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

  <!-- summernote -->

  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <!-- Link to Chart.js library -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

  <style>

    body {

      background-color: #f8f9fa;

    }



    .card {

      background-color: white;

      border: none;

      border-radius: 10px;

      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);

      transition: transform 0.3s, box-shadow 0.3s;

      margin-bottom: 20px;

    }



    .card:hover {

      transform: translateY(-5px);

      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);

    }



    .card-body {

      padding: 20px;

    }



    .card-title {

      font-size: 1.25rem;

      margin-bottom: 10px;

      color: #333;

    }



    .card-text {

      font-size: 1rem;

      color: #555;

    }



    .edit-button {

      background-color: #007bff;

      color: white;

      border: none;

      padding: 10px 15px;

      cursor: pointer;

      border-radius: 5px;

      font-size: 1rem;

      transition: background-color 0.3s;

    }



    .edit-button:hover {

      background-color: #0056b3;

    }



    .modal {

      display: none;

      position: fixed;

      left: 0;

      top: 0;

      width: 100%;

      height: 100%;

      background: rgba(0, 0, 0, 0.5);

      justify-content: center;

      align-items: center;

    }



    .modal-content {

      background: white;

      padding: 20px;

      border-radius: 10px;

      width: 300px;

      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);

    }



    /* ปรับการแสดงผลของป๊อปอัพ */

    .modal {

      display: none; /* ซ่อนป๊อปอัพโดยเริ่มต้น */

      /* ซ่อนป๊อปอัพโดยปริยาย */

      position: fixed;

      /* กำหนดให้ป๊อปอัพอยู่กลางจอ */

      z-index: 1000;

      /* ทำให้ป๊อปอัพอยู่ด้านบนสุด */

      left: 0;

      top: 0;

      width: 100%;

      height: 100%;

      overflow: auto;

      /* กำหนดการเลื่อนในกรณีที่เนื้อหาเกินขอบเขต */

      background-color: rgba(0, 0, 0, 0.5);

      /* พื้นหลังครอบคลุมเนื้อหาด้วยความโปร่งใส */

      display: flex;

      justify-content: center;

      /* จัดวางให้อยู่กลางแนวนอน */

      align-items: center;

      /* จัดวางให้อยู่กลางแนวตั้ง */

    }



    /* กล่องเนื้อหาของป๊อปอัพ */

    .modal-content {

      background-color: #fff;

      /* พื้นหลังสีขาว */

      padding: 20px;

      border-radius: 10px;

      /* มุมกล่องโค้งมน */

      width: 50%;

      /* ความกว้างของกล่อง */

      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);

      /* เงาที่นุ่มนวล */

      max-width: 600px;

      /* กำหนดความกว้างสูงสุด */

      animation: fadeIn 0.3s ease;

      /* เพิ่มแอนิเมชั่นในการแสดง */

    }



    /* จัดปุ่มให้ชิดกัน */

    button {

      padding: 10px 15px;

      background-color: #007bff;

      color: white;

      border: none;

      border-radius: 5px;

      cursor: pointer;

      font-size: 1em;

      transition: background-color 0.3s ease;

      margin-right: 10px;

      /* เพิ่มระยะห่างระหว่างปุ่ม */

    }



    button:last-child {

      margin-right: 0;

    }



    /* เมื่อวางเม้าส์บนปุ่ม */

    button:hover {

      background-color: #0056b3;

    }



    /* ปุ่มปิด */

    button.close-btn {

      background-color: #dc3545;

    }



    /* ปรับแต่งการจัดวางปุ่ม */

    .button-container {

      display: flex;

      justify-content: center;

      margin-top: 20px;

    }



  

input[type="number"],

input[type="file"],

textarea {

    border: 1px solid #ced4da; /* สีขอบ */

    border-radius: 6px; /* มุมกลม */

    padding: 12px; /* ช่องว่างภายใน */

    width: 100%; /* ทำให้กว้างเต็ม */

    box-sizing: border-box; /* รวม padding และ border ในความกว้าง */

    transition: border-color 0.3s; /* เพิ่มเอฟเฟกต์การเปลี่ยนสี */

}



input[type="number"]:focus,

input[type="file"]:focus,

textarea:focus {

    border-color: #007bff; /* เปลี่ยนสีขอบเมื่อโฟกัส */

    outline: none; /* ลบกรอบ */

}



    /* แอนิเมชั่นในการแสดงป๊อปอัพ */

    @keyframes fadeIn {

      from {

        opacity: 0;

      }



      to {

        opacity: 1;

      }

    }

  </style>

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

          <a href="/admin/product.php" class="nav-link">จัดการสินค้า</a>

        </li>

        <li class="nav-item d-none d-sm-inline-block">

          <a href="" class="nav-link">จัดการหมวดหมู่</a>

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

                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">

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

                  จัดการสินค้า

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

              <h1 class="m-0">จัดการผลงาน</h1>

            </div>

          </div>

        </div>

      </div>



      <section class="content">

        <div class="container-fluid">

          <h2>แกลเลอรีการฝึกงาน</h2>

          <?php if (empty($boxes)): ?>

          <p>ไม่มีรายการที่จะโชว์</p>

          <?php else: ?>

          <div class="row">

            <?php foreach ($boxes as $box): ?>

            <div class="col-md-4">

              <div class="card">

                <div class="card-body">

                  <h5 class="card-title">หมายเลขสัปดาห์:

                    <?php echo htmlspecialchars($box['week_number']); ?>

                  </h5>

                  <p class="card-text">คำบรรยาย:

                    <?php echo htmlspecialchars($box['description']); ?>

                  </p>

                  <button class="edit-button"

                    onclick="showEditModal(<?php echo $box['id']; ?>, '<?php echo htmlspecialchars($box['week_number']); ?>', '<?php echo htmlspecialchars($box['description']); ?>', '<?php echo htmlspecialchars($box['image_url_1']); ?>', '<?php echo htmlspecialchars($box['image_url_2']); ?>', '<?php echo htmlspecialchars($box['image_url_3']); ?>')">แก้ไข</button>

                </div>

              </div>

            </div>

            <?php endforeach; ?>

          </div>

          <?php endif; ?>

        </div>

      </section>



    <!-- ป๊อปอัพสำหรับแก้ไขข้อมูล -->

<div id="editModal" class="modal">

    <div class="modal-content">

        <h3 style="text-align:center; margin-bottom:20px;">แก้ไขข้อมูล</h3>

        <form method="post" action="" enctype="multipart/form-data">

            <input type="hidden" id="editId" name="id" />

            <div style="margin-bottom:10px;">

                <label for="week_number">หมายเลขสัปดาห์:</label>

                <input type="number" id="editWeekNumber" name="week_number" required />

            </div>

            <div style="margin-bottom:10px;">

                <label for="description">คำบรรยาย:</label>

                <textarea id="editDescription" name="description" required></textarea>

            </div>

            <div style="margin-bottom:10px;">

                <label for="image_url_1">รูปภาพ 1:</label>

                <input type="file" id="editImageUrl1" name="image_url_1" />

            </div>

            <div style="margin-bottom:10px;">

                <label for="image_url_2">รูปภาพ 2:</label>

                <input type="file" id="editImageUrl2" name="image_url_2" />

            </div>

            <div style="margin-bottom:10px;">

                <label for="image_url_3">รูปภาพ 3:</label>

                <input type="file" id="editImageUrl3" name="image_url_3" />

            </div>

            <!-- ปุ่มบันทึกและปิด -->

            <div class="button-container">

                <button type="submit" name="update">บันทึก</button>

                <button type="button" class="close-btn" onclick="hideEditModal()">ปิด</button>

            </div>

        </form>

    </div>

</div>



<script>

    // ปิดป๊อปอัพเริ่มต้น

    document.addEventListener('DOMContentLoaded', function () {

        var modal = document.querySelector('.modal');

        modal.style.display = 'none'; // ซ่อนป๊อปอัพเมื่อโหลดหน้า

    });



    // ฟังก์ชันสำหรับแสดงป๊อปอัพเมื่อคลิกปุ่มแก้ไข

    function openModal() {

        var modal = document.querySelector('.modal');

        modal.style.display = 'flex'; // แสดงป๊อปอัพ

    }



    // ฟังก์ชันสำหรับปิดป๊อปอัพ

    function closeModal() {

        var modal = document.querySelector('.modal');

        modal.style.display = 'none'; // ซ่อนป๊อปอัพ

    }



    function showEditModal(id, week_number, description) {

        document.getElementById('editId').value = id;

        document.getElementById('editWeekNumber').value = week_number;

        document.getElementById('editDescription').value = description;

        

        document.getElementById('editModal').style.display = 'flex'; // แสดงป๊อปอัพ

    }



    function hideEditModal() {

        document.getElementById('editModal').style.display = 'none'; // ปิดป๊อปอัพ

    }

      // เมื่อโหลดหน้าเว็บ, ตั้งค่า accept ให้กับไฟล์อินพุต

      document.addEventListener('DOMContentLoaded', function() {

        // กำหนด accept="../uploads/" ให้กับไฟล์อินพุต

        document.getElementById('editImageUrl1').accept = '../uploads/';

        document.getElementById('editImageUrl2').accept = '../uploads/';

        document.getElementById('editImageUrl3').accept = '../uploads/';

    });



    // ฟังก์ชันสำหรับปิดป๊อปอัพ

    function hideEditModal() {

        document.getElementById('editModal').style.display = 'none';

    }

</script>



    </div>

  </div>

</body>



<!-- jQuery -->

<script src="plugins/jquery/jquery.min.js"></script>

<!-- jQuery UI 1.11.4 -->

<script src="plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<script>

  $.widget.bridge('uibutton', $.ui.button)

</script>

<!-- Bootstrap 4 -->

<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- ChartJS -->

<script src="plugins/chart.js/Chart.min.js"></script>

<!-- Sparkline -->

<script src="plugins/sparklines/sparkline.js"></script>

<!-- JQVMap -->

<script src="plugins/jqvmap/jquery.vmap.min.js"></script>

<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

<!-- jQuery Knob Chart -->

<script src="plugins/jquery-knob/jquery.knob.min.js"></script>

<!-- daterangepicker -->

<script src="plugins/moment/moment.min.js"></script>

<script src="plugins/daterangepicker/daterangepicker.js"></script>

<!-- Tempusdominus Bootstrap 4 -->

<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Summernote -->

<script src="plugins/summernote/summernote-bs4.min.js"></script>

<!-- overlayScrollbars -->

<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- AdminLTE App -->

<script src="dist/js/adminlte.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<script src="dist/js/pages/dashboard.js"></script>





</html>