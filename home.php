<?php
// home.php

session_start();

// If the user has logged out
if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: home.php");
    exit;
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>EstateLink</title>
</head>

<body>
<section class="hero">
    <div class="login-signup">
        <?php if(isset($_SESSION["username"])) : ?>
        <form action="home.php" method="POST">
            <input type="submit" name="logout" value="Log out">
        </form>
        <?php else : ?>
        <a href="login.php">Login</a> | <a href="register.php">Sign up</a>
        <?php endif; ?>
    </div>
    <div class="hero-text">
        <h1>Welcome to EstateNexus<?php if(isset($_SESSION["username"])) { echo ", " . $_SESSION["username"]; } ?>!</h1>
        <p>Your one-stop solution for seamless property transactions</p>
    </div>
</section>


    <div class="container">
        <div class="row">
        <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">What We Do</h5>
                        <p>EstateLink bridges the gap between property buyers and sellers by offering a unified platform for seamless transactions. Our personalized seller dashboard, easy property management, creative design, and agile development makes property management a breeze.</p>
                    </div>
                </div>
            </div>
           
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 EstateLink Inc.</p>
        </div>
    </footer>
</body>

</html>