<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="css/dashboard.css">
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

  <div class="card-container">
    <a href="manage_wardens.html" class="card">
      <img src="img/warden.jpg" alt="Warden Icon" class="card-image"> <h2>Manage Wardens</h2>
    </a>
    <a href="manage_landlords.html" class="card">
      <img src="img/landlord.jpg" alt="Landlord Icon" class="card-image"> <h2>Manage Landlords</h2>
    </a>
    <a href="manage_students.html" class="card">
      <img src="img/student.jpg" alt="Student Icon" class="card-image"> <h2>Manage Students</h2>
    </a>
    <a href="view_articles.html" class="card">
      <img src="img/article.jpg" alt="Article Icon" class="card-image"> <h2>View Articles</h2>
    </a>
  </div>

</body>
</html>
