<?php

// Include the database connection file
include 'dbconnect.php';

// Get the data from the AJAX call
$data = json_decode(file_get_contents("php://input"), true);

// Get the house ID and new status from the data
$houseId = $data['houseid'];
$newStatus = $data['status'];

// Prepare and execute the update query
$query = "UPDATE boardinghouse SET status = ? WHERE houseid = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $newStatus, $houseId);

if($stmt->execute()) {
    echo "Status updated successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
