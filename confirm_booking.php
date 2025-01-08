<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "safeparking";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$garageId = $_POST['garageId'];
$hours = $_POST['hours'];
$totalPrice = $_POST['totalPrice'];
$sql = "INSERT INTO bookings (garageId, hours, totalPrice) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sid", $garageId, $hours, $totalPrice);
if ($stmt->execute()) {
    echo "Booking confirmed successfully!";
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>
