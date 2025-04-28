<?php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../login.php');
    exit();
}

// Include the function to load project data
function loadProjectData() {
    if (!file_exists('../contacts.json')) {
        return ['contacts' => []];
    }
    $json = file_get_contents('../contacts.json');
    return json_decode($json, true);
}

$projects = loadProjectData();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Egycon Contracting</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">
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
                        <li class="nav-item">
                            <a href="../contact_info/index.php" class="nav-link">
                                <i class="nav-icon fas fa-address-card"></i>
                                <p>
                                    Contact Information
                                </p>
                            </a>
                        </li>
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

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h6>Egycon Contracting, Administrator</h6>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <form action="./create_process.php?id=1" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header bg-black">
                                    <h3 class="card-title ">Contact Information</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php
                                        // Display success message if it exists
                                        if (isset($_SESSION['success'])) {
                                            echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['success']) . '</div>';
                                            unset($_SESSION['success']);
                                        }
                                    ?>
                                    <div class="form-group">
                                        <label for="address">Office Address</label>
                                        <input type="text" id="address" class="form-control" name="address" value="<?php echo htmlspecialchars($projects['contacts'][0]['address']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Office Contact</label>
                                        <input type="text" id="phone" class="form-control" name="phone" value="<?php echo htmlspecialchars($projects['contacts'][0]['phone']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Official Email</label>
                                        <input type="text" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($projects['contacts'][0]['email']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Working hours</label>
                                        <input type="text" id="working_hours" name="working_hours" class="form-control" placeholder="Mon - Sat | 9am to 6pm" value="<?php echo htmlspecialchars($projects['contacts'][0]['working_hours']); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                        <a href="#" class="btn btn-secondary bg-black">Cancel</a>
                        <input type="submit" value="Update Information" class="btn btn-warning float-right">
                        </div>
                    </div>
                </form>
            </section>
        </div>


        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
    </div>

    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="../dist/js/adminlte.min.js"></script>
</body>

</html>