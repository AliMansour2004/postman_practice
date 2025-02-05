<?php
$errorMessages = [
    1 => "First name is required.",
    //2 => "Last name is required.",
    2 => "Username is required.",
    3 => "Email is required.",
    4 => "Password is required.",
    5 => "Invalid email format.",
    6 => "Username already exists.",
    501 => "Signup failed. Please try again later."
];

$error = $_GET['error'] ?? '';

if ($error && isset($errorMessages[$error])) {
    echo "<p class='error-message'>" . $errorMessages[$error] . "</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signup</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/signup.css">
</head>

<body>

<div class="signup-container ">

    <form action="signup_action.php" method="POST" class="form-container">
        <div class="form-group">
            <label for="first_name">First name:</label>
            <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last name:</label>
            <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" required>
        </div>

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <div class="button-container">
            <button type="submit">Signup</button>
            <button type="reset">Reset</button>
        </div>
    </form>
</div>

</body>

</html>