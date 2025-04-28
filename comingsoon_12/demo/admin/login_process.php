<?php
session_start();

function loadUserData() {
    $json = file_get_contents('users.json');
    return json_decode($json, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = loadUserData();

    foreach ($data['users'] as $user) {
        if ($user['email'] === $username && $user['password'] === $password) {
            // Set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            // Redirect to dashboard
            header('Location: ./projects');
            exit();
        }
    }
    echo "Invalid credentials!";
}
?>
