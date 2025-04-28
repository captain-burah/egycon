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
        $img_info = getimagesize($_FILES['img']['tmp_name']);
        // Validate file type and size
        if ($img_info) {
            $img_name = basename($_FILES['img']['name']);
            $img_path = '../../assets/img/project/' . basename($_FILES['img']['name']);
            move_uploaded_file($_FILES['img']['tmp_name'], $img_path);

            // Update the image path
            $projects['projects'][$project_index]['img'] = $img_name;
        } else {
            echo "Invalid file. Please ensure it meets the specified requirements.";
        }
    }

    // Save updated data
    saveProjectData($projects);

    // Set success message
    $_SESSION['success'] = "Project updated successfully!";

    // Redirect to dashboard or success page
    header('Location: ./show.php');
    exit();
}
?>