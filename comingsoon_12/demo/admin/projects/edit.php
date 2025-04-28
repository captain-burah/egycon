<?php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../login.php');
    exit();
}

// Include the function to load project data
include './loadProjectDataFunction.php';

$projects = loadProjectData();
$project_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($project_id === null) {
    echo "Invalid project ID.";
    exit();
}

$project = null;
foreach ($projects['projects'] as $index => $p) {
    if ($p['id'] == $project_id) {
        $project = $p;
        $project_index = $index;
        break;
    }
}

if ($project === null) {
    echo "Project not found.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];

    // Update the project details
    $projects['projects'][$project_index]['name'] = $name;
    $projects['projects'][$project_index]['description'] = $description;
    $projects['projects'][$project_index]['location'] = $location;

    // Check if a new image is uploaded
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        
        // Validate file type and size
        if ($img_info) {
            $img_path = '../../assets/img/project/' . basename($_FILES['img']['name']);
            move_uploaded_file($_FILES['img']['tmp_name'], $img_path);

            // Update the image path
            $projects['projects'][$project_index]['img'] = $img_path;
        } else {
            echo "Invalid file. Please ensure it meets the specified requirements.";
        }
    }

    // Save updated data
    saveProjectData($projects);

    // Redirect to dashboard or success page
    header('Location: ./show.php');
    exit();
}
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
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link mx-auto">

                <span class="brand-text font-weight-light mx-auto">Egycon Admin Panel</span>
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
                <form action="edit_process.php?id=<?php echo htmlspecialchars($project_id); ?>" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-dark">
                                <div class="card-header">
                                <h3 class="card-title">Edit Project</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                </div>
                                <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Project Name</label>
                                            <input type="text" id="name" class="form-control" name="name" value="<?php echo htmlspecialchars($project['name']); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Project Description</label>
                                            <textarea id="description" class="form-control" name="description" rows="4"><?php echo htmlspecialchars($project['description']); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="location">Project Location</label>
                                            <input type="text" id="location" name="location" class="form-control" value="<?php echo htmlspecialchars($project['location']); ?>">
                                        </div>
                                        <div class="form-group mb-0">
                                            <label for="img">Project Image</label>
                                        </div>
                                        <div class="mb-2">
                                            <small><img src="../../assets/img/project/<?php echo htmlspecialchars($project['img']); ?>" alt="Project Image" width="auto" height="200"></small>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="img" name="img">
                                            <label class="custom-file-label" for="exampleInputFile">Choose File</label>
                                            <small>resolution height: 409px and width: 409px | image format .webp | size less than 50kb</small>
                                        </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        <!-- /.card -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                        <a href="#" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Update Project" class="btn btn-success float-right">
                        </div>
                    </div>
                </form>
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

    <script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
</body>

</html>