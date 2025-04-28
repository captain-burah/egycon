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
foreach ($projects['contacts'] as $index => $p) {
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
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $working_hours = $_POST['working_hours'];

    // Update the project details
    $projects['contacts'][$project_index]['address'] = $address;
    $projects['contacts'][$project_index]['phone'] = $phone;
    $projects['contacts'][$project_index]['email'] = $email;
    $projects['contacts'][$project_index]['working_hours'] = $working_hours;


    // Save updated data
    saveProjectData($projects);

    // Set success message
    $_SESSION['success'] = "Contact information updated successfully!";

    // Redirect to dashboard or success page
    header('Location: ./index.php');
    exit();
}
?>