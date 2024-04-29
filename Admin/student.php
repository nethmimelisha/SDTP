<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO student (std_id, name, email, batch, address, phone_number, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $std_id, $name, $email, $batch, $address, $phone, $password);

    // Set parameters
    $std_id = $_POST['std_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $batch = $_POST['batch'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Execute SQL statement
    if ($stmt->execute()) {
        echo '<script>alert("Student registered successfully.");</script>';
    } else {
        echo '<script>alert("Error: ' . $conn->error . '");</script>';
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
  <title>Student</title>
  <link rel="stylesheet" href="css/warden.css">
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
<br><br><br>
  <form action="student.php" method="post">
    <h2>Student Registration</h2>
    <div class="form-group">
      <label for="std_id">Student ID:</label>
      <input type="text" name="std_id" id="std_id" required>
    </div>
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" name="name" id="name" required>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>
    </div>
    <div class="form-group">
        <label for="batch">Batch:</label>
        <input type="text" name="batch" id="batch" required>
      </div>
      <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" required>
      </div>
      <div class="form-group">
        <label for="phone">Phone Number:</label>
        <input type="text" name="phone" id="phone" required>
      </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required>
    </div>
    <button type="generate" onclick="createPassword()">Generate Password</button>
    <button type="submit">Register Warden</button>
  </form>

  <script>

    const passwordBox = document.getElementById("password");
    const lenght = 8;

    const upperCase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const lowerCase = "abcdefghijklmnopqrstuvwxyz";
    const number = "0123456789";
    const symbol = "@#&$*_+/-=";

    const allChars = upperCase + lowerCase + number + symbol;

    function createPassword(){
        let password = "";
        password += upperCase[Math.floor(Math.random() * upperCase.length)];
        password += lowerCase[Math.floor(Math.random() * lowerCase.length)];
        password += number[Math.floor(Math.random() * number.length)];
        password += symbol[Math.floor(Math.random() * symbol.length)];

        while (lenght > password.length){
            password += allChars[Math.floor(Math.random() * allChars.length)];
        }
        passwordBox.value = password;
    }

</script>

</body>
</html>