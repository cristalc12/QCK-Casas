<!DOCTYPE html>
<html>
<head>
    <title>Add Property</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Add Property</h2>
    <form action="save_property.php" method="POST" enctype="multipart/form-data">
        <label>Title</label>
        <input type="text" name = "title" id="title" required><br> 
        <label>Description</label>
        <textarea name="description" id = "description" required></textarea><br>
        <label>Image</label>
        <input type="file" name="image" id = "image" required><br>
        <label>Year Built</label>
        <input type="number" name="yearBuilt" id = "yearBuilt" required><br>
        <label>Price</label>
        <input type="number" name="price" id = "price" required><br>
        <label>Bathrooms</label>
        <input type="number" name="bathrooms" id = "bathrooms" required><br>
        <label>Bedrooms</label>
        <input type="number" name="bedrooms" id = "bedrooms" required><br>
        <button type="submit" name = "submit">Submit</button>
        <button type="button" onclick="goBack()">Cancel</button>
    </form>
    <script src="dashboard.js"></script>
</body>
</html>
