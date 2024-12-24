<?php
include '../Check.php'; // Check login
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - จัดการผลงาน</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <style>
body {
    font-family: 'Kanit', sans-serif;
    background-color: #e9ecef; /* สีพื้นหลังอ่อน */
    margin: 0;
    padding: 0;
}
.gallery-title {
    text-align: center; /* จัดข้อความกลาง */
    color: #495057; /* สีข้อความ */
    margin-bottom: 30px; /* ระยะห่างด้านล่าง */
    font-size: 2em; /* ขนาดข้อความ */
}

.content-wrapper {
    padding: 20px;
    background-color: #f8f9fa; /* สีพื้นหลังของฟอร์ม */
    border-radius: 10px; /* มุมกลม */
    border: 1px solid #ced4da; /* ขอบรอบฟอร์ม */
}

h2 {
    color: #007bff; /* สีหัวข้อ */
    margin-bottom: 20px; /* ระยะห่างด้านล่าง */
    font-size: 1.5em; /* ขนาดข้อความ */
}

.form-group {
    margin-bottom: 20px; /* ระยะห่างระหว่างฟอร์มกรุ๊ป */
}

label {
    font-weight: bold; /* ทำให้ข้อความ label หนัก */
    color: #343a40; /* สีข้อความ label */
}

input[type="number"],
input[type="url"],
textarea {
    border: 1px solid #ced4da; /* สีขอบ */
    border-radius: 6px; /* มุมกลม */
    padding: 12px; /* ช่องว่างภายใน */
    width: 100%; /* ทำให้กว้างเต็ม */
    box-sizing: border-box; /* รวม padding และ border ในความกว้าง */
    transition: border-color 0.3s; /* เพิ่มเอฟเฟกต์การเปลี่ยนสี */
}

input[type="number"]:focus,
input[type="url"]:focus,
textarea:focus {
    border-color: #007bff; /* เปลี่ยนสีขอบเมื่อโฟกัส */
    outline: none; /* ลบกรอบ */
}

.btn-primary {
    background-color: #007bff; /* สีปุ่ม */
    border: none; /* ไม่มีขอบ */
    color: #ffffff; /* สีข้อความในปุ่ม */
    padding: 12px 20px; /* ช่องว่างภายใน */
    border-radius: 6px; /* มุมกลม */
    cursor: pointer; /* เปลี่ยนเคอร์เซอร์เมื่อเมาส์วาง */
    transition: background-color 0.3s; /* เพิ่มเอฟเฟกต์การเปลี่ยนสี */
    font-size: 1em; /* ขนาดข้อความในปุ่ม */
}

.btn-primary:hover {
    background-color: #0056b3; /* เปลี่ยนสีเมื่อเมาส์วาง */
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
          <a href="#" class="nav-link">จัดการหมวดหมู่</a>
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
                  เพิ่มข้อมูล
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/edit_week.php" class="nav-link">
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
    <main>
    <div class="container mt-5">
        <h1 class="gallery-title">การฝึกงาน</h1>
        <!-- Form for Adding New Work -->
        <div class="content-wrapper mb-5">
            <h2 class="text-dark">เพิ่มข้อมูลผลงาน</h2>
            <form id="addInternshipForm">
                <div class="form-group">
                    <label for="week_number">หมายเลขสัปดาห์:</label>
                    <input type="number" name="week_number" id="week_number" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="image_url_1">URL ของรูปภาพ 1:</label>
                    <input type="file" name="image_url_1" id="image_url_1" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="image_url_2">URL ของรูปภาพ 2:</label>
                    <input type="file"name="image_url_2" id="image_url_2" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="image_url_3">URL ของรูปภาพ 3:</label>
                    <input type="file" name="image_url_3" id="image_url_3" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">รายละเอียด:</label>
                    <textarea name="description" id="description" class="form-control" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
            </form>
        </div>
    </div>
</main>

<script>
    document.getElementById('addInternshipForm').addEventListener('submit', function (e) {
        e.preventDefault(); // ป้องกันการส่งฟอร์มแบบปกติ

        const formData = new FormData(this); // รับข้อมูลจากฟอร์ม

        // ส่งข้อมูลฟอร์มด้วย fetch API
        fetch('add_process.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // แสดง SweetAlert เมื่อเพิ่มข้อมูลสำเร็จ
                swal("สำเร็จ!", data.message, "success");
            } else {
                // แสดง SweetAlert เมื่อมีข้อผิดพลาด
                swal("ผิดพลาด!", data.message, "error");
            }
        })
        .catch(error => {
            // แสดง SweetAlert เมื่อเกิดข้อผิดพลาดในการเชื่อมต่อ
            swal("ผิดพลาด!", "เกิดข้อผิดพลาดในการเชื่อมต่อ", "error");
        });
    });
</script>
<!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

<!-- SweetAlert JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <footer class="main-footer">
        <strong>Copyright &copy; 2024 <a href="#">Your Company</a>.</strong> All rights reserved.
    </footer>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.js"></script>
</body>
</html>
