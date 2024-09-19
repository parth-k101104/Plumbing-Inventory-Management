<?php
// update_add.php

// Enable error reporting
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

// Retrieve data from POST request
$item = $_POST['item'];
$quantity = (int)$_POST['quantity'];
$table = $_POST['table'];

// Validate quantity
if ($quantity <= 0) {
    echo "Invalid quantity.";
    $conn->close();
    exit;
}

// Validate table name to prevent SQL injection
$validTables = ['swr', 'pvc', 'apvc', 'cpvc', 'paint', 'miscellaneous', 'sanitary'];
if (!in_array($table, $validTables)) {
    echo "Invalid table name.";
    $conn->close();
    exit;
}

// Update the database
$sql = "UPDATE `$table` SET quantity = quantity + ? WHERE item = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $quantity, $item);
$stmt->execute();

// Close the statement and connection
$stmt->close();
$conn->close();

// Return a response
echo "Quantity updated successfully";
?>
