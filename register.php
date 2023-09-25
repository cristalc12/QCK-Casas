<?php
$servername = "localhost";
$username = "sagustin1";
//username = password  = dbname
$password = "sagustin1";
$dbname = "sagustin1";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the MySQL database (replace the placeholders with actual credentials)
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and validate input data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $registration_date = date("Y-m-d"); // Set the registration date to the current date
    $userType = $_POST["userType"]; // Get the userType from the form
    $address = $_POST["address"]; // Get the address from the form
    $city = $_POST["city"]; // Get the city from the form
    $state = $_POST["state"]; // Get the state from the form
    $zip_code = $_POST["zip_code"]; // Get the zip code from the form

    // Check if the password and confirmation password match
    if ($password !== $confirm_password) {
        die("Password and confirmation password do not match.");
    }

    // Check if the userType is one of the allowed values (seller, buyer, admin)
    $allowed_userTypes = array('seller', 'buyer', 'admin');
    if (!in_array($userType, $allowed_userTypes)) {
        die("Invalid userType value.");
    }

    // Perform password hashing (use a secure algorithm like bcrypt in production)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (username, password, first_name, last_name, registration_date, userType, address, city, state, zip_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $username, $hashed_password, $first_name, $last_name, $registration_date, $userType, $address, $city, $state, $zip_code);

    if ($stmt->execute()) {
        echo "Registration successful. Please <a href='login.php'>log in</a>.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
    <h2>Registration</h2>
    <form action="register.php" method="POST">
        First Name: <input type="text" name="first_name" required><br>
        Last Name: <input type="text" name="last_name" required><br>
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        Confirm Password: <input type="password" name="confirm_password" required><br>
        User Type:
        <select name="userType" required>
            <option value="seller">Seller</option>
            <option value="buyer">Buyer</option>
            <option value="admin">Admin</option>
        </select><br>
        Address: <input type="text" name="address" required><br>
        City: <input type="text" name="city" required><br>
        State: <input type="text" name="state" required><br>
        Zip Code: <input type="text" name="zip_code" required><br>
        <input type="submit" value="Register">
        <button><a href="login.php">Back to Login</a></button>
    </form>
</body>
</html>
