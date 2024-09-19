<?php
// Start the session
session_start();

// Check if the session variable for the username is set
if (!isset($_SESSION['username'])) {
    // If not set, redirect the user back to the login page
    header("Location: login.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
        <div class="sidebar1">
                <?php echo $_SESSION['username'] ?>
                <hr>
            </div>
            <div class="sidebar2">
                <ul>
                    <li class="sidebar-item active" data-file="swr.php">SWR</li>
                    <li class="sidebar-item" data-file="apvc.php">APVC</li>
                    <li class="sidebar-item" data-file="pvc.php">PVC</li>
                    <li class="sidebar-item" data-file="cpvc.php">CPVC</li>
                    <li class="sidebar-item" data-file="paint.php">Paint</li>
                    <li class="sidebar-item" data-file="miscellaneous.php">Miscellaneous</li>
                    <li class="sidebar-item" data-file="sanitary.php">Sanitary</li>
                </ul>
            </div>
            <div class="sidebar3">
                <form method="POST" action="dashboard.php">
                    <button type="submit" name="logout">Logout</button>
                </form>
            </div>
        </div>
        <div class="main-content">
        <div class="main-head">
            <div class="header">
                <h1>Dhammalaya Store Stock</h1>
            </div>
        </div>
            <div class="content">
                <?php include 'swr.php'; ?>
            </div>
        </div>
    </div>
    <script src="app1.js"></script>
</body>
</html>
