<?php
$servername = "localhost";
$username = "root";
$password = "pk.101104";  // Replace 'your_password' with the actual password
$dbname = "plumbing";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}

$conn->close();
?>
