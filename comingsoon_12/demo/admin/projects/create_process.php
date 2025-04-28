<?php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../login.php');
    exit();
}


// Function to load project data from JSON file
function loadProjectData() {
    if (!file_exists('../projects.json')) {
        return ['projects' => []];
    }
    $json = file_get_contents('../projects.json');
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
    file_put_contents('../projects.json', json_encode($data, JSON_PRETTY_PRINT));
}

// Function to handle file upload errors
function checkFileUploadError($errorCode) {
    switch ($errorCode) {
        case UPLOAD_ERR_OK:
            return 'There is no error, the file uploaded successfully.';
        case UPLOAD_ERR_INI_SIZE:
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
        case UPLOAD_ERR_FORM_SIZE:
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
        case UPLOAD_ERR_PARTIAL:
            return 'The uploaded file was only partially uploaded.';
        case UPLOAD_ERR_NO_FILE:
            return 'No file was uploaded.';
        case UPLOAD_ERR_NO_TMP_DIR:
            return 'Missing a temporary folder.';
        case UPLOAD_ERR_CANT_WRITE:
            return 'Failed to write file to disk.';
        case UPLOAD_ERR_EXTENSION:
            return 'A PHP extension stopped the file upload.';
        default:
            return 'Unknown upload error.';
    }
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];

    // Check if file is uploaded
    if (isset($_FILES['img'])) {
        
        if ($_FILES['img']['error'] == UPLOAD_ERR_OK) {
            $max_size = 50 * 1024; // 50KB
            $img_info = getimagesize($_FILES['img']['tmp_name']);

            // Validate file type and size
            if ($img_info) {
                $img_name = basename($_FILES['img']['name']);
                $img_path = '../../assets/img/project/' . basename($_FILES['img']['name']);
                move_uploaded_file($_FILES['img']['tmp_name'], $img_path);

                // Load existing projects
                $data = loadProjectData();

                 // Get the next project ID
                $new_id = getNextProjectId($data['projects']);

                // Create new project array
                $new_project = [
                    'id' => $new_id,
                    'name' => $name,
                    'description' => $description,
                    'location' => $location,
                    'img' => $img_name
                ];

                // Append new project
                $data['projects'][] = $new_project;

                // Save updated data
                saveProjectData($data);

                // Set success message
                $_SESSION['success'] = "Project updated successfully!";

                // Redirect to dashboard or success page
                header('Location: ./show.php');
                exit();
            } else {
                echo "Invalid file. Please ensure it meets the specified requirements.";
            }
        } else {
            $error_message = checkFileUploadError($_FILES['img']['error']);
            echo "File upload error: " . $error_message;
        }
    } else {
        echo "File not uploaded.";
    }
}
?>
