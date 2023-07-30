<?php
// home.php
$servername = "localhost";
$username = "sagustin1";
//username = password  = dbname
$password = "sagustin1";
$dbname = "sagustin1";
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

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="grid-container">
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <button class="material-icons-outlined" type="submit"><img src="icons\menu.png" style="background:transparent;"/></button>
            </div>
            <div class="header-left">
                <button class="material-icons-outlined" type="submit"><img src="icons\search.png"/></button>
            </div>
            <div class="header-right">
                <button class="material-icons-outlined" type="submit"><img src="icons\notification.png"/></button>
                <button class="material-icons-outlined" type="submit"><img src="icons\mail.png"/></button>
                
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
                <button class="material-icons-outlined" type="submit"><img src="icons\grid.png"/></button>Dashboard
                </li>
                <li class="sidebar-list-item">
                    <button class="material-icons-outlined" type="submit"><img src="icons\home.png"/></button>All Listings
                </li>
                <li class="sidebar-list-item">
                    <button class="material-icons-outlined" type="submit"><img src="icons\pending.png"/></button>Inquiries
                </li>
                <li class="sidebar-list-item">
                    <button class="material-icons-outlined" type="submit"><img src="icons/settings.png"/></button>Settings
                </li>
                <li>
                    <form action="home.php" method="POST">
                        <button class = "logout" type="submit" name="logout"> Log Out
                    </form>
                </li>
            </ul>
        </aside>

        <main class="main-container">
            <div class="main-title">
                <p class="font-weight-bold">DASHBOARD</p>
                <button class="material-icons-outlined">Add Property<a href="add_property.php" id="add-property-button"><img src="icons/add.png"/></a></button> 
            </div>
            <section class="main-cards">
                <div class = "card-container">
                    <?php

                    $sql = "SELECT * FROM properties";
                    $stmt = mysqli_stmt_init($conn);

                    if(mysqli_stmt_prepare($stmt, $sql)) {
                        echo "SQL statement failed";
                    } else {
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<a href = "#">
                                <div style = "background-image: url(includes/'.$row["title"].');"></div>
                                <h3>'.$row["title"].'</h3>
                                <p>'.$row["description"].'</p>
                                <p>'.$row["yearBuilt"].'</p>
                            </a>';
                        }
                    }


                    
                    ?>
                </div>

            </section>
       
           
        </main>

    <script src="dashboard.js"></script>
</body>
</html>
