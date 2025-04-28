<?php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../login.php');
    exit();
}

function loadUserData() {
    if (!file_exists('../users.json')) {
        return ['users' => []];
    }
    $json = file_get_contents('../users.json');
    return json_decode($json, true);
}

$users = loadUserData();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Egycon Contracting</title>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <style>
        .description-cell {
            
            white-space: normal;
            overflow-wrap: break-word;
            word-wrap: break-word;
            word-break: break-word;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 10; /* Number of lines to display */
            -webkit-box-orient: vertical;
        }
    </style>
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
                <span class="brand-text font-weight-bold mx-auto">Egycon Admin Panel</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
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

            <!-- Main content -->
            <section class="content">

                <div class="card">
                    <div class="card-header">
                        <h4>All Users</h4>
                    </div>
                    
                    <div class="card-body">
                        <?php
                                // Display success message if it exists
                            if (isset($_SESSION['success'])) {
                                echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['success']) . '</div>';
                                unset($_SESSION['success']);
                            }
                        ?>
                        <a href="./add.php" class="btn btn-dark bg-black">Add User</a>
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if (isset($users['users']) && is_array($users['users'])) {
                                        foreach ($users['users'] as $index => $user) {
                                            echo '<tr>';
                                            echo '<td>' . htmlspecialchars($user['id']) . '</td>';
                                            echo '<td>' . htmlspecialchars($user['name']) . '</td>';
                                            echo '<td>' . htmlspecialchars($user['email']) . '</td>';
                                            echo '<td>' . htmlspecialchars($user['password']) . '</td>';
                                            echo '<td><a href="./edit.php?id=' . $user['id'] . '" class="btn btn-outline-dark">Edit</a> | <a href="./delete_process.php?id=' . $user['id'] . '" class="btn btn-outline-dark">Delete</a></td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="6">No projects found.</td></tr>';
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
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