<?php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../login.php');
    exit();
}


// Function to load project data from JSON file
function loadProjectData() {
    if (!file_exists('../users.json')) {
        return ['users' => []];
    }
    $json = file_get_contents('../users.json');
    return json_decode($json, true);
}

// Function to get the next project ID
function getNextProjectId($projects) {
    $maxId = 0;
    foreach ($projects as $project) {
        if ($project['id'] > $maxId) {
            $maxId = $project['id'];
        }
    }
    return $maxId + 1;  
}

// Function to save project data to JSON file
function saveProjectData($data) {
    file_put_contents('../users.json', json_encode($data, JSON_PRETTY_PRINT));
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Load existing projects
    $data = loadProjectData();

    // Get the next project ID
   $new_id = getNextProjectId($data['users']);

   // Create new project array
   $new_project = [
       'id' => $new_id,
       'name' => $name,
       'email' => $email,
       'password' => $password,
   ];

   // Append new project
   $data['users'][] = $new_project;

   // Save updated data
   saveProjectData($data);

   // Set success message
   $_SESSION['success'] = "User Created successfully!";

   // Redirect to dashboard or success page
   header('Location: ./show.php');
   exit();
}
?>
