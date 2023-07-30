<?php
$servername = "localhost";
$username = "sagustin1";
$password = "sagustin1";
$dbname = "sagustin1";

$conn = mysqli_connect($servername, $username, $password, $dbname);

session_start();

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $yearBuilt = $_POST['yearBuilt'];
    $bathrooms = $_POST['bathrooms'];
    $bedrooms = $_POST['bedrooms'];

    $file = $_FILES['image'];
    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNewName = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = '/includes' . $fileNewName;

                $user_id = $_SESSION["user_id"];
                $sql = "INSERT INTO properties (user_id, title, description, image_url, price, yearBuilt, bathrooms, bedrooms) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL statement failed";
                } else {
                    mysqli_stmt_bind_param($stmt, "isssssss", $user_id, $title, $description, $fileNewName, $price, $yearBuilt, $bathrooms, $bedrooms);
                    mysqli_stmt_execute($stmt);

                    move_uploaded_file($fileTmpName, $fileDestination);

                    header("Location: dashboard.php?upload=success");
                    exit();
                }
            } else {
                echo "Your file is too big";
            }
        } else {
            echo "There was an error uploading your file!";
        }
    } else {
        echo "You cannot upload files of this type!";
    }
}

header("Location: dashboard.php");
exit;
?>
