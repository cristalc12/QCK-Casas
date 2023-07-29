<!DOCTYPE html>
<html>
<head>
    <title>Add Property</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Add Property</h2>
    <form action="save_property.php" method="POST">
        Title
        <input type="text" name="title" required><br> 
        Year Built:
        <input type = "number" name = "year-built"><br>
        Location
        <input type = "text" name = "location" required><br>
        Description
        <textarea name="description"  required></textarea><br>
        Images
        <input type="file" name="image" required><br>
        Price
        <input type="number" name="price" required><br>
        <legend> Does this property have a garden?</legend>
            <div>
                <input type = "radio" name = "garden" id = "garden-no" value = "no" checked> No
                <input type = "radio" name = "garden" id = "garden-yes" value = "yes"/> Yes
            </div>
        <br>
        No. of Bathrooms
        <input type = "number" name = "bathrooms" required><br>
        No. of Bedrooms
        <input type = "number" name = "bedrooms" required><br>
        <input type="submit" value="Save">
        <button type="button" onclick="goBack()">Cancel</button>
    </form>
</body>
</html>