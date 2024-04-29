<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landlord</title>
  <link rel="stylesheet" href="css/dashboard.css">
  <link rel="stylesheet" href="css/viewproperty.css">
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

  <div class="property-container">
    <?php
    // Include the database connection file
    include 'dbconnect.php';

    // Query to fetch property details
    $query = "SELECT * FROM properties";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
      // Output data of each row
      while ($row = $result->fetch_assoc()) {
        echo "<div class='property'>";
        echo "<h2>{$row['name']}</h2>";
        echo "<p><strong>Description:</strong> {$row['description']}</p>";
        echo "<p><strong>Price:</strong> {$row['price']}</p>";
        echo "<p><strong>Amenities:</strong> {$row['amenities']}</p>";
        echo "<p><strong>Nearby Places:</strong> {$row['nearby_places']}</p>";
        echo "<p><strong>Landlord:</strong> {$row['landlord']}</p>";
        echo "<p><strong>Contact Number:</strong> {$row['contact_no']}</p>";
        echo "<div class='property-images'>";
        echo "<img src='{$row['image1']}' alt='Property Image 1'>";
        echo "<img src='{$row['image2']}' alt='Property Image 2'>";
        echo "</div>";
        echo "</div>";
      }
    } else {
      echo "No properties found.";
    }

    // Close the database connection
    $conn->close();
    ?>
  </div>
</body>
</html>
