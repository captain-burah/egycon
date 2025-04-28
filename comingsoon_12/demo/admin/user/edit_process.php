<?php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../login.php');
    exit();
}

// Include the function to load project data
include './loadUserDataFunction.php';

$projects = loadUserData();
$project_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($project_id === null) {
    echo "Invalid project ID.";
    exit();
}

$project = null;
foreach ($projects['users'] as $index => $p) {
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
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Update the project details
    $projects['users'][$project_index]['name'] = $name;
    $projects['users'][$project_index]['email'] = $email;
    $projects['users'][$project_index]['password'] = $password;

    // Save updated data
    saveUserData($projects);

    // Set success message
    $_SESSION['success'] = "User updated successfully!";

    // Redirect to dashboard or success page
    header('Location: ./show.php');
    exit();
}
?>