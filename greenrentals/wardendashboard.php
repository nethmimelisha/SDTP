<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warden Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    include 'dbconnect.php';
    ?>

    <!-- Header -->
    <header class="d-flex justify-content-between align-items-center p-3 bg-white">
        <!-- Logo -->
        <img src="assets/logo.png" alt="Logo" style="height: 50px;"> 

        <!-- Title -->
        <h1 class="mb-0">Warden Dashboard</h1>

        <!-- Logout Button -->
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </header>

    <!-- Body -->
    <div class="container mt-5">
        <!-- Top Bar -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#published" data-toggle="tab">Published</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#new-requests" data-toggle="tab">New Requests</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#removed" data-toggle="tab">Removed</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#declined" data-toggle="tab">Declined</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <div class="tab-pane fade show active" id="published">
                <!-- Published Boarding Houses Table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Boarding House Name</th>
                            <th>Owner Name</th>
                            <th>Contact No</th>
                            <th>No of Available Spaces</th>
                            <th>Ratings</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- PHP to retrieve and display data for published boarding houses -->
                        <?php
                        // Query to get the published boarding houses
                        $query = "SELECT * FROM boardinghouse WHERE status = 'published'";
                        $result = mysqli_query($conn, $query);

                        // Check if the query returns any rows
                        if (mysqli_num_rows($result) > 0) {
                            // Output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                <td>{$row['housename']}</td>
                                <td>{$row['landlordname']}</td>
                                <td>{$row['contact']}</td>
                                <td>{$row['available_spaces']}</td>
                                <td>{$row['ratings']}</td>
                                <td>
                                    <a href='boardinghouse.php?houseid={$row['houseid']}' class='btn btn-primary'>
                                    <i class='bi bi-pencil-square'></i>
                                    </a>
                                </td>
                            </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No Published Boarding Houses</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="new-requests">
                <!-- New Requests Table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Boarding House Name</th>
                            <th>Owner Name</th>
                            <th>Contact No</th>
                            <th>No of Available Spaces</th>
                            <th>Ratings</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- PHP to retrieve and display data for new requests -->
                        <?php
                        // Query to get the new requests
                        $query = "SELECT * FROM boardinghouse WHERE status = 'new'";
                        $result = mysqli_query($conn, $query);

                        // Check if the query returns any rows
                        if (mysqli_num_rows($result) > 0) {
                            // Output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                <td>{$row['housename']}</td>
                                <td>{$row['landlordname']}</td>
                                <td>{$row['contact']}</td>
                                <td>{$row['available_spaces']}</td>
                                <td>{$row['ratings']}</td>
                                <td>
                                    <a href='boardinghousenew.php?houseid={$row['houseid']}' class='btn btn-primary'>
                                    <i class='bi bi-pencil-square'></i>
                                    </a>
                                </td>
                            </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No New Requests</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="removed">
                <!-- Published Boarding Houses Table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Boarding House Name</th>
                            <th>Owner Name</th>
                            <th>Contact No</th>
                            <th>No of Available Spaces</th>
                            <th>Ratings</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- PHP to retrieve and display data for published boarding houses -->
                        <?php
                        // Query to get the published boarding houses
                        $query = "SELECT * FROM boardinghouse WHERE status = 'removed'";
                        $result = mysqli_query($conn, $query);

                        // Check if the query returns any rows
                        if (mysqli_num_rows($result) > 0) {
                            // Output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                <td>{$row['housename']}</td>
                                <td>{$row['landlordname']}</td>
                                <td>{$row['contact']}</td>
                                <td>{$row['available_spaces']}</td>
                                <td>{$row['ratings']}</td>
                                <td>
                                    <a href='boardinghousenew.php?houseid={$row['houseid']}' class='btn btn-primary'>
                                    <i class='bi bi-pencil-square'></i>
                                    </a>
                                </td>
                            </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No Published Boarding Houses</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>


            <div class="tab-pane fade" id="declined">
                <!-- Published Boarding Houses Table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Boarding House Name</th>
                            <th>Owner Name</th>
                            <th>Contact No</th>
                            <th>No of Available Spaces</th>
                            <th>Ratings</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- PHP to retrieve and display data for published boarding houses -->
                        <?php
                        // Query to get the published boarding houses
                        $query = "SELECT * FROM boardinghouse WHERE status = 'declined'";
                        $result = mysqli_query($conn, $query);

                        // Check if the query returns any rows
                        if (mysqli_num_rows($result) > 0) {
                            // Output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                <td>{$row['housename']}</td>
                                <td>{$row['landlordname']}</td>
                                <td>{$row['contact']}</td>
                                <td>{$row['available_spaces']}</td>
                                <td>{$row['ratings']}</td>
                                <td>
                                    <a href='boardinghousenew.php?houseid={$row['houseid']}' class='btn btn-primary'>
                                    <i class='bi bi-pencil-square'></i>
                                    </a>
                                </td>
                            </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No Published Boarding Houses</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>



        </div>
    </div>

    <!-- Bootstrap and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <!-- Custom JS -->
    <script src="script.js"></script>

</body>

</html>