<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "safeParking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch total parking slots
$sql_total_parking_slots = "SELECT SUM(num_parking_spaces) AS total_parking_slots FROM garage_owners";
$result_total_parking_slots = $conn->query($sql_total_parking_slots);
$row_total_parking_slots = $result_total_parking_slots->fetch_assoc();
$totalParkingSlots = $row_total_parking_slots['total_parking_slots'];

// Fetch total users
$sql_total_users = "SELECT COUNT(*) AS total_users FROM (SELECT id FROM vehicle_owners UNION ALL SELECT id FROM garage_owners) AS combined";
$result_total_users = $conn->query($sql_total_users);
$row_total_users = $result_total_users->fetch_assoc();
$totalUsers = $row_total_users['total_users'];

// Fetch last 2 registered vehicle owners
$sql_recent_vehicle_owners = "SELECT name FROM vehicle_owners ORDER BY id DESC LIMIT 2";
$result_recent_vehicle_owners = $conn->query($sql_recent_vehicle_owners);
$recentUsers = [];
while ($row = $result_recent_vehicle_owners->fetch_assoc()) {
    $recentUsers[] = $row['name'];
}

// Fetch last 2 registered garage owners
$sql_recent_garage_owners = "SELECT name FROM garage_owners ORDER BY id DESC LIMIT 2";
$result_recent_garage_owners = $conn->query($sql_recent_garage_owners);
$recentGarageOwners = [];
while ($row = $result_recent_garage_owners->fetch_assoc()) {
    $recentGarageOwners[] = $row['name'];
}

// Mock data for recent activities and parking slots (if needed)
$recentActivities = [
    "User John Doe booked a slot at Downtown Garage",
    "User Jane Smith booked a slot at Westside Apartment"
];

$recentParkingSlots = [
    "Downtown Garage - Available - $20",
    "Westside Apartment - Not Available - $15"
];

// Prepare data to send to JavaScript
$data = [
    "totalParkingSlots" => $totalParkingSlots,
    "totalUsers" => $totalUsers,
    "bookingsToday" => count($recentActivities),
    "recentActivities" => $recentActivities,
    "recentUsers" => $recentUsers,
    "recentParkingSlots" => $recentParkingSlots
];

// Close connection
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($data);
?>
