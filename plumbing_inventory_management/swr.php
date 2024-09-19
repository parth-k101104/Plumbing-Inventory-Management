<?php
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

// Query the database to fetch item details
$sql = "SELECT item, quantity, unit FROM swr;";
$result = $conn->query($sql);

// Display results in a table with external CSS
if ($result->num_rows > 0) {
    echo "<div class='table-container'>"; // Container div for the table
    echo "<table class='inventory-table'>";
    echo "<thead><tr><th>Item</th><th>Quantity in Stock</th><th>Unit</th><th>Actions</th></tr></thead>";
    echo "<tbody>";
    while($row = $result->fetch_assoc()) {
        $item = htmlspecialchars($row["item"]);
        $quantity = (int)$row["quantity"];
        $unit = htmlspecialchars($row["unit"]);

        echo "<tr>";
        echo "<td>$item</td>";
        echo "<td>$quantity</td>";
        echo "<td>$unit</td>";
        echo "<td>
              <button class='consume-button' onclick=\"updateQuantity('consume', 'swr', '$item', $quantity)\">Consume</button>
              <button class='add-button' onclick=\"updateQuantity('add', 'swr', '$item', $quantity)\">Add</button>
              </td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>"; // End of container div
} else {
    echo "0 results";
}

$conn->close();
?>


