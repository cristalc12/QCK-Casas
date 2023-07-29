<?php
// home.php

session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

// Logout functionality
if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION["user_id"]; 

$sql = "SELECT * FROM properties WHERE user_id = $user_id";
$result = $conn->query($sql);

$properties = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $properties[] = $row;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body>
    <div class="grid-container">
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
            <div class="header-left">
                <span class="material-icons-outlined">search</span>
            </div>
            <div class="header-right">
                <span class="material-icons-outlined">notifications</span>
                <span class="material-icons-outlined">email</span>
                <span class="material-icons-outlined">account_circle</span>
            </div>
        </header>

        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="sidebar-title font-weight-bold">
                <div class="sidebar-brand"><?php echo $_SESSION["username"]; ?>'s Inventory</div>
                <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
            </div>
            <ul class="sidebar-list">
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">grid_view</span>Dashboard
                </li>
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">home</span>All Listings
                </li>
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">pending</span>Inquiries
                </li>
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">settings</span>Settings
                </li>
            </ul>
        </aside>

        <main class="main-container">
            <div class="main-title">
                <p class="font-weight-bold">DASHBOARD</p>
            </div>
            <a href="add_property.php" id="add-property-button">+</a>
            <div class="main-cards">
                <?php foreach ($properties as $property) { ?>
                    <a href="property_details.php?id=<?php echo $property["id"]; ?>">
                        <div class="property-card">
                        <img src="<?php echo $property["image_url"]; ?>" alt="<?php echo $property["title"]; ?>">
                            <div class="property-details">
                                <h3><?php echo $property["title"]; ?></h3>
                                <p><?php echo $property["city"] . ', ' . $property["state"]; ?></p>
                            </div>
                        </div>
                    </a>
                <?php } ?>
    
                <?php if (empty($properties)) { ?>
                    <p>No properties found.</p>
                <?php } ?>
            </div>


    
    <form action="home.php" method="POST">
        <input type="submit" name="logout" value="Log out">
    </form>

    <script src="dashboard.js"></script>
</body>
</html>
