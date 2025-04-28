<?php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../login.php');
    exit();
}

// Include the function to load project data
include './loadUserDataFunction.php';

$users = loadUserData();
$user_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($user_id === null) {
    echo "Invalid project ID.";
    exit();
}

// Find the project index
$user_index = null;
foreach ($users['users'] as $index => $user) {
    if ($user['id'] == $user_id) {
        $user_index = $index;
        break;
    }
}

if ($user_index === null) {
    echo "Project not found.";
    exit();
}

// Remove the project from the array
unset($users['users'][$user_index]);

// Reindex the array to ensure sequential IDs
$users['users'] = array_values($users['users']);

// Save updated data
saveUserData($users);

// Redirect to dashboard or success page
header('Location: ./show.php');
exit();
?>
