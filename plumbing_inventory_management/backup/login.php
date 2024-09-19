<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost";
$username = "root";
$password = "pk.101104";
$dbname = "plumbing";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Redirect to dashboard if already logged in
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $nameOrContact = trim(mysqli_real_escape_string($conn, $_POST['nameOrContact']));
    $password = trim(mysqli_real_escape_string($conn, $_POST['password']));

    // Query the database to check if the username/contact and password exist
    $query = "SELECT * FROM users WHERE (username = '$nameOrContact' OR contact = '$nameOrContact') AND pwd = '$password'";
    $result = mysqli_query($conn, $query);

    // Check if any record matches
    if (mysqli_num_rows($result) == 1) {
        // Fetch user data
        $user = mysqli_fetch_assoc($result);

        session_start();

        // Set session variables
        $_SESSION['username'] = $user['username'];

        // Redirect to the dashboard or any other page
        header("Location: dashboard.php");
        exit();
    } else {
        // If no match found, display an error message
        $error_message = "Invalid username or password.";
    }
    
    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="heading">
        <h1>Dhammalaya store stock</h1>
    </div>
    <br><br><br>
    <div class="form-container">
        <h2>Admin Login</h2>
        <form id="loginForm" action="login.php" method="POST">
            <label for="nameOrContact">Username/Contact no. :</label>
            <input type="text" id="nameOrContact" name="nameOrContact" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
            <a href="register.php">New Admin Registration?</a>
        </form>
        <div id="login-error-message"></div>
    </div>
    
    <!--<script src="login.js"></script>-->
</body>
</html>