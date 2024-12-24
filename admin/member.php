<?php
include '../Check.php'; // Check login
include '../config.php'; // เชื่อมต่อกับฐานข้อมูลโดยใช้ PDO

try {
    // คำสั่ง SQL สำหรับดึงข้อมูล
    $sql = "SELECT id, username, email, created_at, role FROM users"; // เพิ่ม email เข้าไปใน SELECT
    $stmt = $pdo->prepare($sql); // เตรียมคำสั่ง SQL
    $stmt->execute(); // ประมวลผลคำสั่ง

    // ดึงข้อมูลทั้งหมด
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // จัดการข้อผิดพลาด
    echo "Error: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE php>
<php lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>
  <link rel="icon" href="https://cdn.discordapp.com/attachments/1093611863897559211/1154797217375322132/364806853_1025807301934485_544726315995811807_n.jpg?ex=653298b7&is=652023b7&hm=6dc2bd4092041f058d60232252def4b9ad488aa44a1e23d70cfb2e6f280015d5&">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
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

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">ข้อมูลสมาชิก</h1>
            </div>
          </div>
        </div>
      </div>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">สมาชิกทั้งหมด</h3>
                </div>
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th> <!-- เพิ่มคอลัมน์สำหรับ Email -->
                        <th>เวลาที่สร้าง</th>
                        <th>ยศ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // แสดงผลข้อมูลสมาชิก
                      try {
                          if (count($result) > 0) {
                              foreach ($result as $row) {
                                  echo "<tr>
                                      <td>" . $row["id"] . "</td>
                                      <td>" . $row["username"] . "</td>
                                      <td>" . $row["email"] . "</td> <!-- แสดง Email -->
                                      <td>" . $row["created_at"] . "</td>
                                      <td>" . $row["role"] . "</td>
                                  </tr>";
                              }
                          } else {
                              echo "<tr><td colspan='5'>ไม่พบข้อมูล</td></tr>"; // เปลี่ยนจำนวนคอลัมน์
                          }
                      } catch (PDOException $e) {
                          echo "Error: " . $e->getMessage();
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
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

<?php
// ปิดการเชื่อมต่อ
$conn->close();
?>
