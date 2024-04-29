<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boarding House Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
// Include the database connection file
include 'dbconnect.php';
// Get the houseid from the URL
$houseid = $_GET['houseid'];

// Fetch the boarding house details
$query = "SELECT * FROM boardinghouse WHERE houseid = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $houseid);
$stmt->execute();
$result = $stmt->get_result();
$house = $result->fetch_assoc();
?>

<!-- Header -->
<header class="d-flex justify-content-between align-items-center p-3 bg-white">
    <img src="assets/logo.png" alt="Logo" style="height: 50px;"> 
    <h1 class="mb-0">Property Details </h1>
    <a href="logout.php" class="btn btn-danger">Logout</a> 
</header>

<!-- Body -->
<div class="container mt-3">

    <!-- Bootstrap Carousel for House Images -->
    <div id="houseImagesCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            $images = [];
            for ($i = 1; $i <= 3; $i++) {
                if (!empty($house['img' . $i])) {
                    $images[] = $house['img' . $i];
                }
            }
            if (empty($images)) { 
                $images[] = 'house_dummy.png';
            }
            foreach ($images as $index => $img) {
                echo "<div class='carousel-item " . ($index === 0 ? "active" : "") . "'>";
                echo "<img src='{$img}' class='d-block w-100' alt='...'>";
                echo "</div>";
            }
            ?>
        </div>
        <?php if(count($images) > 1): ?>
        <a class="carousel-control-prev" href="#houseImagesCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#houseImagesCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <?php endif; ?>
    </div>

    <!-- House Details -->
    <div class="house-details mt-4">
        <h2><?php echo htmlspecialchars($house['housename']); ?></h2>
        <p><strong>Owner:</strong> <?php echo htmlspecialchars($house['landlordname']); ?></p>
        <p><strong>Contact:</strong> <?php echo htmlspecialchars($house['contact']); ?></p>
        <p><strong>Available Spaces:</strong> <?php echo htmlspecialchars($house['available_spaces']); ?></p>
        <p><strong>Ratings:</strong> <?php echo str_repeat('★', $house['ratings']) . str_repeat('☆', 5 - $house['ratings']) . " ({$house['ratings']}/5)"; ?></p>
        <p><strong>Facilities:</strong> <?php echo htmlspecialchars($house['facilities']); ?></p>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($house['description']); ?></p>
    </div>

    <!-- Google Maps -->
    <div id="googleMap" style="width:100%;height:400px;"></div>

    <!-- Approve and Decline Buttons -->
<div class="actions mt-4">
    <button onclick="changeStatus('published')" class="btn btn-success">Approve</button>
    <button onclick="changeStatus('declined')" class="btn btn-danger">Decline</button>
</div>
</div>

<script>
var houseId = <?php echo json_encode($house['houseid']); ?>;

function changeStatus(newStatus) {
    // Prepare the data to send in the request
    var dataToSend = {
        houseid: houseId,
        status: newStatus
    };

    // Create an AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_status.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE) {
            if (this.status === 200) {
                alert("The status has been updated to " + newStatus + ".");
                location.reload(); 
            } else {
                alert("An error occurred: " + this.responseText);
            }
        }
    };

    // Send the AJAX request with the data
    xhr.send(JSON.stringify(dataToSend));
}

</script>

<script>
// Initialize and add the map
function initMap() {
    var latitude = parseFloat(<?php echo json_encode($house['loclat']); ?>);
    var longitude = parseFloat(<?php echo json_encode($house['loclong']); ?>);
    var location = { lat: latitude, lng: longitude };

    var map = new google.maps.Map(
        document.getElementById('googleMap'), {zoom: 15, center: location}
    );
    var marker = new google.maps.Marker({position: location, map: map});
}
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9frHtLF5jWElTlT2CVLzOxFM1qUGdmFs&callback=initMap">
</script>

<!-- Bootstrap and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<!-- Custom JS -->
<script src="script.js"></script>

</body>
</html>
