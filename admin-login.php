<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $usernameOrEmail = $_POST['username_or_email'];
    $password = $_POST['password'];

    // Validate the login credentials (replace this with your actual validation logic)
    $correctUsername = "admin";
    $correctPassword = "1234";

    if ($usernameOrEmail == $correctUsername && $password == $correctPassword) {
        // Authentication successful
        $_SESSION['username'] = $usernameOrEmail;
        header("Location: Admin/dashboard.php"); // Redirect to admin dashboard or any other page
        exit();
    } else {
        // Authentication failed
        $error_message = "Invalid username/email or password!";
    }
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
    <title>Web Master</title>
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
            <div class="dropdown">
                <button class="btn white-btn" id="loginBtn">
                    Sign In <i class='bx bx-caret-down'></i>
                </button>
                <div class="dropdown-content">
                    <a href="admin-login.html" onclick="loginAs('Admin')">Admin</a>
                    <a href="warden-login.html" onclick="loginAs('Warden')">Warden</a>
                    <a href="landlord-login.html" onclick="loginAs('Landlord')">Landlord</a>
                    <a href="std-login.html" onclick="loginAs('Student')">Student</a>
                </div>
            </div>
        </div>

        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>
<!----------------------------- Form box ----------------------------------->    
    <div class="form-box">
        
        <!------------------- login form -------------------------->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="login-container" id="login">
            <div class="top">
                <header>Web Master Login</header>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" placeholder="Username or Email" name="username_or_email" required>
                <i class="bx bx-user"></i>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" placeholder="Password" name="password" required>
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
            <?php
            if (isset($error_message)) {
                echo '<div class="error-message">' . $error_message . '</div>';
            }
            ?>
        </div>
        </form>
        
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
