<?php
include '../Check.php'; // Check login
include '../config.php'; // เชื่อมต่อกับฐานข้อมูล

    // Fetch member count from the 'users' table
    $sql = "SELECT COUNT(*) AS users FROM users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $memberCount = $row ? $row['users'] : 0;

    // Fetch project count from the 'box' table
    $sql = "SELECT COUNT(*) AS project_count FROM box";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $projectCount = $row ? $row['project_count'] : 0;

    // Query to fetch all records from 'box' table
    $sql = "SELECT * FROM box";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>
                    <?php echo $memberCount; ?>
                  </h3>
                  <p>สมาชิก</p>
                </div>
                <div class="icon">
                  <i class="fa-solid fa-user"></i>
                </div>
                <a href="member.php" class="small-box-footer">แสดงรายละเอียด<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>
                    <h3>
                      <?php echo $projectCount; ?>
                    </h3>
                    <p>ผลงาน</p>
                </div>
                <div class="icon">
                  <i class="fa-solid fa-store"></i>
                </div>
                <a href="/product.php" class="small-box-footer">แสดงรายละเอียด<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="container my-4">
  <div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>แสดงผลข้อมูล</h2>
            <table 
                data-toggle="table" 
                data-search="true" 
                data-show-columns="true" 
                data-show-refresh="true"
                data-page-list="[10, 25, 50, 100, ALL]" 
                data-show-pagination-switch="true" 
                data-pagination="true"
                data-url="data.php">
                <thead>
                    <tr>
                        <th data-field="id">ID</th>
                        <th data-field="week_number">สัปดาห์</th>
                        <th data-field="description">รายละเอียด</th>
                        <th data-field="image_url_1" data-formatter="imageFormatter">รูปภาพ 1</th>
                        <th data-field="image_url_2" data-formatter="imageFormatter">รูปภาพ 2</th>
                        <th data-field="image_url_3" data-formatter="imageFormatter">รูปภาพ 3</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- รวม JavaScript libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="http://issues.wenzhixin.net.cn/bootstrap-table/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-th-TH.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- ฟังก์ชันสำหรับแสดงรูปภาพขนาดย่อ -->
<script>
function imageFormatter(value, row, index) {
    return `<img src="${value}" alt="รูปภาพ" class="img-thumbnail" style="width: 40px; height: 40px;">`;
}
</script>

              <section>
                <!-- Control Sidebar -->
                <aside class="control-sidebar control-sidebar-dark">
                  <!-- Control sidebar content goes here -->
                </aside>
                <!-- /.control-sidebar -->
            </div>
            <!-- ./wrapper -->

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
</body>

</html>