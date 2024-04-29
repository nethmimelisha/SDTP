<?php
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
    $stmt = $conn->prepare("INSERT INTO warden (warden_id, name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $warden_id, $name, $email, $password);

    // Set parameters and execute
    $warden_id = $_POST['warden_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt->execute();

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Redirect to another page and display alert
    echo "<script>alert('Warden registered successfully.'); window.location.href = 'index.php';</script>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navigation Panel</title>
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
  <form action="warden.php" method="post">
    <h2>Warden Registration</h2>
    <div class="form-group">
      <label for="warden_id">Warden ID:</label>
      <input type="text" name="warden_id" id="warden_id" required>
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