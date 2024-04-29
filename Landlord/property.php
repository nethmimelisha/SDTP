<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection file
    include 'dbconnect.php';

    // Retrieve form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $amenities = $_POST['amenities'];
    $nearbyPlaces = $_POST['nearbyPlaces'];
    $landlord = $_POST['landlord'];
    $contactNo = $_POST['contactNo'];

    // File upload handling for image 1
    $image1 = '';
    if (isset($_FILES['image1']) && $_FILES['image1']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image1"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if (in_array($imageFileType, $allowedExtensions)) {
            if (move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file)) {
                $image1 = $target_file;
            } else {
                echo "<script>alert('Error uploading image 1.');</script>";
                exit;
            }
        } else {
            echo "<script>alert('Invalid file format for image 1. Only JPG, JPEG, PNG, and GIF files are allowed.');</script>";
            exit;
        }
    } else {
        echo "<script>alert('Error uploading image 1.');</script>";
        exit;
    }

    // File upload handling for image 2
    $image2 = '';
    if (isset($_FILES['image2']) && $_FILES['image2']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image2"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if (in_array($imageFileType, $allowedExtensions)) {
            if (move_uploaded_file($_FILES["image2"]["tmp_name"], $target_file)) {
                $image2 = $target_file;
            } else {
                echo "<script>alert('Error uploading image 2.');</script>";
                exit;
            }
        } else {
            echo "<script>alert('Invalid file format for image 2. Only JPG, JPEG, PNG, and GIF files are allowed.');</script>";
            exit;
        }
    } else {
        echo "<script>alert('Error uploading image 2.');</script>";
        exit;
    }

    // Prepare and execute SQL insert statement
    $query = "INSERT INTO properties (name, description, price, amenities, nearby_places, landlord, contact_no, image1, image2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssss", $name, $description, $price, $amenities, $nearbyPlaces, $landlord, $contactNo, $image1, $image2);
    if ($stmt->execute()) {
        echo "<script>alert('Property added successfully.');</script>";
    } else {
        echo "<script>alert('Error adding property: " . $stmt->error . "');</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landlord</title>
  <link rel="stylesheet" href="css/property.css">
</head>
<body>
  <nav>
    <div class="logo">
      <img src="img/logo.png" alt="Logo">
      <span>Landlord Dashboard</span>
    </div>
    <ul class="nav-links">
      <li class="dropdown">
        <a href="property.php">Add Property</a>
      </li>
      <li class="dropdown">
        <a href="viewproperty.php">View Property</a>
      </li>
      <li class="dropdown">
        <a href="std-reserve.php">Reservations</a>
      </li>
    </ul>
    <a href="#" class="logout">Logout</a>
  </nav>
  <br><br><br>
  <form action="property.php" method="post">
    <h2>Add Property</h2>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>
    <label for="description">Description:</label>
    <input type="text" id="description" name="description" required><br><br>
    <label for="price">Price:</label>
    <input type="text" id="price" name="price" required><br><br>
    <label for="amenities">Amenities:</label>
    <input type="text" id="amenities" name="amenities" required><br><br>
    <label for="nearbyPlaces">Nearby Places:</label>
    <input type="text" id="nearbyPlaces" name="nearbyPlaces" required><br><br>
    <label for="landlord">Landlord:</label>
    <input type="text" id="landlord" name="landlord" required><br><br>
    <label for="contactNo">Contact Number:</label>
    <input type="text" id="contactNo" name="contactNo" required><br><br>
    <label for="image1">Image 1:</label>
    <input type="file" id="image1" name="image1" accept="image/*" required><br><br>
    <label for="image2">Image 2:</label>
    <input type="file" id="image2" name="image2" accept="image/*" required><br><br>
    <input type="submit" value="Submit">
  </form>
</body>
</html>
