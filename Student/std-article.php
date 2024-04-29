<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "greenrentals";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve articles from database
$sql = "SELECT * FROM articles";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landlord</title>
  <link rel="stylesheet" href="css/std-article.css">
</head>
<body>
  <nav>
    <div class="logo">
      <img src="img/logo.png" alt="Logo">
      <span>Student Dashboard</span>
    </div>
    <ul class="nav-links">
      <li class="dropdown">
        <a href="std-article.php">Articles</a>
      </li>
      <li class="dropdown">
        <a href="std-property.php">View Property</a>
      </li>
    </ul>
    <a href="#" class="logout">Logout</a>
  </nav>

  <br><br>
  <h1>Articles</h1>
  <div class="article-container">
    <br><br><br><br>
    <?php
    // Check if there are articles in the database
    if ($result->num_rows > 0) {
        // Loop through each row of the result set
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="article">
              <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>">
              <h3><?php echo $row['title']; ?></h3>
              <p><?php echo $row['description']; ?></p>
            </div>
            <?php
        }
    } else {
        echo "No articles found.";
    }
    ?>
  </div>


</body>
</html>

  