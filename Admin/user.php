<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$db_password = ""; 
$dbname = "greenrentals";

// Create connection
$conn = new mysqli($servername, $username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the Student table
$sql_student = "SELECT * FROM student_reg";
$result_student = $conn->query($sql_student);

// Retrieve data from the Warden table
$sql_warden = "SELECT * FROM warden_reg";
$result_warden = $conn->query($sql_warden);

// Retrieve data from the Landlord table
$sql_landlord = "SELECT * FROM landlord_reg";
$result_landlord = $conn->query($sql_landlord);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Requests</title>
    <link rel="stylesheet" href="css/user.css">
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
    <br> <br> <br> <br>

    <div class="container">
        <h1>Student Registration</h1>
        <table>
            <tr>
                <th>Student ID</th>
                <th>Batch</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Action</th>
                <!-- Add more table headers as needed -->
            </tr>
            <?php
            // Display data from the Student table
            if ($result_student->num_rows > 0) {
                while($row = $result_student->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["student_id"] . "</td>";
                    echo "<td>" . $row["batch"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";
                    echo "<td>" . $row["phone"] . "</td>";
                    echo "<td>";
                    echo "<form action='handle_reservation.php' method='POST'>";
                    echo "<input type='hidden' name='reservation_id' value='" . $row["student_id"] . "'>";
                    echo "<button type='submit' name='accept'>Accept</button>";
                    echo "<button type='submit' name='reject'>Decline</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No student registrations found</td></tr>";
            }
            ?>
        </table>
    </div>

    <div class="container">
        <h1>Warden Registration</h1>
        <table>
            <tr>
                <th>Warden ID</th>
                <th>Warden Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <!-- Display data from the Warden table -->
            <?php
            if ($result_warden->num_rows > 0) {
                while($row = $result_warden->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["warden_id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>";
                    echo "<form action='handle_reservation.php' method='POST'>";
                    echo "<input type='hidden' name='reservation_id' value='" . $row["warden_id"] . "'>";
                    echo "<button type='submit' name='accept'>Accept</button>";
                    echo "<button type='submit' name='reject'>Decline</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No warden registrations found</td></tr>";
            }
            ?>
        </table>
    </div>

    <div class="container">
        <h1>Landlord Registration</h1>
        <table>
            <tr>
                <th>Landlord Name</th>
                <th>NIC</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Action</th>
            </tr>
            <!-- Display data from the Landlord table -->
            <?php
            if ($result_landlord->num_rows > 0) {
                while($row = $result_landlord->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["nic"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";
                    echo "<td>" . $row["phone"] . "</td>";
                    echo "<td>";
                    echo "<form action='handle_reservation.php' method='POST'>";
                    echo "<input type='hidden' name='reservation_id' value='" . $row["name"] . "'>";
                    echo "<button type='submit' name='accept'>Accept</button>";
                    echo "<button type='submit' name='reject'>Decline</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No landlord registrations found</td></tr>";
            }
            ?>
        </table>
    </div>

</body>
</html>


