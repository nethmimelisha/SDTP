<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "greenrentals";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data and upload image file
    $title = $_POST['title'];
    $description = $_POST['description'];
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

    // Insert data into database
    $sql = "INSERT INTO articles (image, title, description) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $targetFile, $title, $description);

    if ($stmt->execute()) {
        $message = "Article created successfully!";
    } else {
        $message = "Error: " . $stmt->error;
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
  <title>Article</title>
  <link rel="stylesheet" href="css/article.css">
</head>
<body>
  <nav>
  <div class="logo">
      <img src="img/logo.png" alt="Logo">
      <span>Admin Dashboard</span>
    </div>
    <ul class="nav-links">
    <li class="dropdown">
        <a href="user.php">User Registartion</a>
      </li>
      <li class="dropdown">
        <a href="#">Create Accounts</a>
        <ul class="dropdown-content">
          <li><a href="warden.php">Warden</a></li>
          <li><a href="landlord.php">Landlord</a></li>
          <li><a href="student.php">Student</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#">Articles</a>
        <ul class="dropdown-content">
          <li><a href="article.php">Create Article</a></li>
          <li><a href="viewarticle.php">View Articles</a></li>
        </ul>
      </li>
    </ul>
    <a href="#" class="logout">Logout</a>
  </nav>

  <!-- Form for creating an article -->
  <div class="article-form">
    <h2>Create New Article</h2>
    <form action="article.php" method="post" enctype="multipart/form-data">
      <label for="image">Image:</label>
      <input type="file" id="image" name="image" accept="image/*" required><br><br>
      
      <label for="title">Title:</label>
      <input type="text" id="title" name="title" required><br><br>
      
      <label for="description">Description:</label><br>
      <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>
      
      <input type="submit" value="Submit">
    </form>
  </div>


</body>
</html>
