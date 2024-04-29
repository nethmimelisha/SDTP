<?php
// Initialize message variable
$message = "";

// Check if the form is submitted for login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Retrieve form data
    $usernameOrEmail = $_POST['username_or_email'];
    $password = $_POST['password'];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $db_password = ""; 
    $dbname = "your_database_name";

    // Create connection
    $conn = new mysqli($servername, $username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to check login credentials
    $sql = "SELECT id, username_or_email, password_hash FROM warden WHERE username_or_email = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists and password is correct
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPasswordHash = $row['password_hash'];
        if (password_verify($password, $storedPasswordHash)) {
            // Password is correct, login successful
            $message = "Login successful!";
            // You may set session variables or redirect the user to a dashboard here
        } else {
            // Password is incorrect
            $message = "Invalid username/email or password!";
        }
    } else {
        // User does not exist
        $message = "Invalid username/email or password!";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}

// Check if the form is submitted for registration
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Retrieve form data
    $wardenId = $_POST['warden_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $db_password = ""; 
    $dbname = "your_database_name";

    // Create connection
    $conn = new mysqli($servername, $username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert data into database
    $sql = "INSERT INTO warden_reg (warden_id, name, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $wardenId, $name, $email);

    // Execute SQL statement
    if ($stmt->execute()) {
        $message = "Registration successful!";
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
    <title>Landlord</title>
    <style>
        body {
            background-image: url('img/admin2.jpg'); 
        }
    </style>
</head>
<body>
 <div class="wrapper">
    <nav class="nav">
        <div class="nav-logo">
            <img class="logo" src="img/logo.png" alt="Logo">
        </div>
        <div class="nav-menu" id="navMenu">
        </div>
        <div class="nav-button">
            <button class="btn white-btn" id="loginBtn" onclick="login()">Sign In</button>
            <button class="btn" id="registerBtn" onclick="register()">Sign Up</button>
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>
<!----------------------------- Form box ----------------------------------->    
    <div class="form-box">
        
        <!------------------- login form -------------------------->
        <form action="warden-login.php" method="post">
        <div class="login-container" id="login">
            <div class="top">
                <span>Don't have an account? <a href="#" onclick="register()">Sign Up</a></span>
                <header>Warden Login</header>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" placeholder="Username or Email" required>
                <i class="bx bx-user"></i>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" placeholder="Password" required>
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                <input type="submit" class="submit" value="Sign In">
            </div>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="login-check">
                    <label for="login-check"> Remember Me</label>
                </div>
                <div class="two">
                    <label><a href="#">Forgot password?</a></label>
                </div>
            </div>
        </div>
        </form>
        <!------------------- registration form -------------------------->
        <form action="warden-login.php" method="post">
        <div class="register-container" id="register">
            <div class="top">
                <span>Have an account? <a href="#" onclick="login()">Login</a></span>
                <header>Warden Registration</header>
            </div>

            <div class="input-box">
                <input type="text" class="input-field" placeholder="Warden ID" required>
                <i class='bx bxs-id-card'></i>
            </div>

            <div class="input-box">
                    <input type="text" class="input-field" placeholder="Name" required>
                    <i class="bx bx-user"></i>
            </div>

            <div class="input-box">
                <input type="email" class="input-field" placeholder="Email" required>
                <i class="bx bx-envelope"></i>
            </div>

            <div class="input-box">
                <input type="submit" class="submit" value="Register">
            </div>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="register-check">
                    <label for="register-check"> Remember Me</label>
                </div>
                <div class="two">
                    <label><a href="#">Terms & conditions</a></label>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>   
<script>
   
   function myMenuFunction() {
    var i = document.getElementById("navMenu");
    if(i.className === "nav-menu") {
        i.className += " responsive";
    } else {
        i.className = "nav-menu";
    }
   }
 
</script>
<script>
    var a = document.getElementById("loginBtn");
    var b = document.getElementById("registerBtn");
    var x = document.getElementById("login");
    var y = document.getElementById("register");
    function login() {
        x.style.left = "4px";
        y.style.right = "-520px";
        a.className += " white-btn";
        b.className = "btn";
        x.style.opacity = 1;
        y.style.opacity = 0;
    }
    function register() {
        x.style.left = "-510px";
        y.style.right = "5px";
        a.className = "btn";
        b.className += " white-btn";
        x.style.opacity = 0;
        y.style.opacity = 1;
    }
</script>
</body>
</html>