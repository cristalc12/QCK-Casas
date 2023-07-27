<?php
$servername = "localhost";
$username = "sagustin1";
//username = password  = dbname
$password = "sagustin1";
$dbname = "sagustin1";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the MySQL database (replace the placeholders with actual credentials)
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and validate input data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Retrieve the hashed password from the database
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    // Verify the password
    if (password_verify($password, $hashed_password)) {
        $_SESSION["username"] = $username;
        header("Location: home.php");
    } else {
        echo "Invalid username or password.";
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="POST">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
        <button><a href="register.php">New User Registration</a></button>
    </form>
    
</body>
</html>
