<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

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

// Initialize variables for error handling
$error_message = "";

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $username = trim(mysqli_real_escape_string($conn, $_POST['username']));
    $contact = trim(mysqli_real_escape_string($conn, $_POST['contact']));
    $password = trim(mysqli_real_escape_string($conn, $_POST['password']));
    $confirmPassword = trim(mysqli_real_escape_string($conn, $_POST['confirmPassword']));

    // Validate that passwords match
    if ($password !== $confirmPassword) {
        $error_message = "Passwords do not match.";
    } else {

        // Prepare and execute the SQL query to insert the new user
        $query = "INSERT INTO users (username, contact, pwd) VALUES ('$username', '$contact', '$password')";

        if (mysqli_query($conn, $query)) {
            // Registration successful, redirect to login page or dashboard
            header("Location: login.php");
            exit();
        } else {
            // Error during insert operation
            $error_message = "Error: " . mysqli_error($conn);
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="heading">
        <h1>Dhammalaya store stock</h1>
    </div>
    <br><br><br>
    <div class="form-container">
        <h2>Register Admin</h2>
        <form id="registerForm" action="register.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="contact">Contact Number:</label>
            <input type="text" id="contact" name="contact" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>

            <button type="submit">Register</button>
        </form>
        <div id="register-error-message">
            <?php
            // Display error message if exists
            if (!empty($error_message)) {
                echo '<p style="color:red;">' . $error_message . '</p>';
            }
            ?>
        </div>
    </div>
    
    <!--<script src="register.js"></script>-->
</body>
</html>
