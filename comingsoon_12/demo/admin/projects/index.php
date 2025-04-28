<?php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../login.php');
    exit();
}

function loadProjectData() {
    if (!file_exists('../projects.json')) {
        return ['projects' => []];
    }
    $json = file_get_contents('../projects.json');
    return json_decode($json, true);
}

$projects = loadProjectData();

// Calculate the total number of projects
$totalProjects = isset($projects['projects']) ? count($projects['projects']) : 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Egycon Contracting</title>


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">  
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" href="../logout.php">
          <i class="fas fa-sign-out-alt"></i>&nbsp; Log Out
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary bg-black elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link mx-auto text-center">
      <span class="brand-text font-weight-bold text-center mx-auto">Egycon Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			<li class="nav-item">
                <a href="../projects/index.php" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../projects/show.php" class="nav-link">
                    <i class="nav-icon fas fa-laptop-house"></i>
                    <p>
                        All Projects
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../projects/add.php" class="nav-link">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Add New Project
                    </p>
                </a>
            </li>
            <!--<li class="nav-item">-->
            <!--    <a href="../contact_info/index.php" class="nav-link">-->
            <!--        <i class="nav-icon fas fa-address-card"></i>-->
            <!--        <p>-->
            <!--            Contact Information-->
            <!--        </p>-->
            <!--    </a>-->
            <!--</li>-->
            <li class="nav-item">
                <a href="../user/show.php" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        User Mgt.
                    </p>
                </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h6>Egycon Contracting, Administrator</h6>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>



    <section class="content">
      <div class="card">
        <div class="card-header">
          <h4>Dashboard</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-4 col-6">
              <div class="small-box bg-black">
                  <div class="inner">
                    <h3><?php echo $totalProjects; ?></h3>
                    <p>Available Projects</p>
                  </div>
                  <div class="icon text-primary">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                <a href="./show.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-4 col-6">
              <div class="small-box bg-black">
                  <div class="inner">
                    <h3>Project</h3>
                    <p>Add new projects</p>
                  </div>
                  <div class="icon text-warning">
                    <i class=" ion ion-person-add"></i>
                  </div>
                <a href="./add.php" class="small-box-footer">Create <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-4 col-6">
              <div class="small-box bg-black">
                  <div class="inner">
                    <h3>User</h3>
                    <p>Manage Users</p>
                  </div>
                  <div class="icon text-success">
                    <i class="ion ion-bag"></i>
                  </div>
                <a href="../user/show.php" class="small-box-footer">Show <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
