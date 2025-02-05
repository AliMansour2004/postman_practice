<?php
require '../db.php';
require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('/Applications/XAMPP/xamppfiles/htdocs/postman_practice');
$dotenv->load();


try {
    $database = new db($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
} catch (Exception $e) {
    header("Location: signup.php?error=500");//Signup failed. Please try again later.
    exit();
}

$first_name = $_POST['first_name'] ?? '';
if (empty($first_name)) {
    header("Location: signup.php?error=1"); // Error 1: First name required
    exit();
}

$last_name = $_POST['last_name'] ?? '';
//if (empty($last_name)) {
//    header("Location: signup.php?error=2"); // Error 2: Last name required
//    exit();
//}

$username = $_POST['username'] ?? '';
if (empty($username)) {
    header("Location: signup.php?error=2"); // Error 2: Username required
    exit();
}

$email = $_POST['email'] ?? '';
if (empty($email)) {
    header("Location: signup.php?error=3"); // Error 3: Email required
    exit();
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: signup.php?error=4"); // Error 4: Invalid email format
    exit();
}

$password = $_POST['password'] ?? '';
if (empty($password)) {
    header("Location: signup.php?error=5"); // Error 5: Password required
    exit();
}
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

$query = "SELECT id FROM users WHERE username = ?";
try {
    $existingUser = $database->Select($query, [$username]);
    if (count($existingUser) > 0) {
        header("Location: signup.php?error=6"); // Error 6: Username already exists
        exit();
    }
} catch (Exception $e) {
    header("Location: signup.php?error=500"); // Signup failed. Please try again later.
    exit();
}

// Correct INSERT query
$insertQuery = "INSERT INTO users (first_name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?)";

try {
    $database->Insert($insertQuery, [$first_name, $last_name, $username, $email, $hashed_password]);
    header("Location: ../index.php?success=1"); // Success message
    exit();
} catch (Exception $e) {
    header("Location: signup.php?error=500"); // Signup failed. Please try again later.
    exit();
}





