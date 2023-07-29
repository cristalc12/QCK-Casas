<?php
    $servername = "localhost";
    $username = "sagustin1";
    //username = password  = dbname
    $password = "sagustin1";
    $dbname = "sagustin1";

    //Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    //Check connection
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    // Create the 'User' table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        registration_date DATE NOT NULL,
        userType ENUM('seller', 'buyer', 'admin') NOT NULL DEFAULT 'buyer',
        address VARCHAR(255) NOT NULL,
        city VARCHAR(100) NOT NULL,
        state VARCHAR(100) NOT NULL,
        zip_code VARCHAR(10) NOT NULL
    )";

    if($conn->query($sql) === TRUE){
        echo "User database created successfully \r\n";
    }
    else {
        echo "Error creating table: " . $conn->error . "\r\n";
    }

  
$sql_properties = "CREATE TABLE IF NOT EXISTS properties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    created_date DATE NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)";

if ($conn->query($sql_properties) === TRUE) {
    echo "Properties database created successfully.\r\n";
} else {
    echo "Error creating 'properties' table: " . $conn->error . "\r\n";
}


$conn->close();
?>
