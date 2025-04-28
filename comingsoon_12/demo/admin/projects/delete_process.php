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

// Find the project index
$project_index = null;
foreach ($projects['projects'] as $index => $project) {
    if ($project['id'] == $project_id) {
        $project_index = $index;
        break;
    }
}

if ($project_index === null) {
    echo "Project not found.";
    exit();
}

// Remove the project from the array
unset($projects['projects'][$project_index]);

// Reindex the array to ensure sequential IDs
$projects['projects'] = array_values($projects['projects']);

// Save updated data
saveProjectData($projects);

// Redirect to dashboard or success page
header('Location: ./show.php');
exit();
?>
