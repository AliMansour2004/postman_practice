<?php
session_start();
require '../db.php';

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('/Applications/XAMPP/xamppfiles/htdocs/postman_practice');
$dotenv->load();

try {
    $database = new db($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
} catch (Exception $e) {
    header("Location: ../index.php?error=500");//Something went wrong. Please try again later
    exit();
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    header("Location: ../index.php?error=1");//Username and password are required.
    exit();
}

$query = "SELECT id, password FROM users WHERE username = ?";
try {
    $user = $database->Select($query, [$username]);
} catch (Exception $e) {
    header("Location: ../index.php?error=500");//Something went wrong. Please try again later
    exit();
}

if (count($user) > 0) {
    $db_password = $user[0]['password'];

    if (password_verify($password, $db_password)) {
        $_SESSION['user_id'] = $user[0]['id'];
        header("Location: control_panel.php");
    } else {
        header("Location: ../index.php?error=3");// 3 invalid credentials
    }
} else {
    header("Location: ../index.php?error=2");//User not found.
}
exit();