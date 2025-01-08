<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "safeparking";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM garage_owners WHERE id = $user_id";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $user_data = $result->fetch_assoc();
    $garageId = $user_data['garageId']; 
} else {
    die("User not found");
}
$sql_bookings = "SELECT * FROM bookings WHERE garageId = '$garageId'";
$result_bookings = $conn->query($sql_bookings);

$bookings_data = [];
if ($result_bookings->num_rows > 0) {
    while ($row = $result_bookings->fetch_assoc()) {
        $bookings_data[] = $row;  
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage Owner Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    :root {
    --primary-color: #2c3e50;
    --secondary-color: #3498db;
    --background-color: #f4f7f6;
    --text-color: #333;
    --accent-color: #27ae60;
    --card-background: #ffffff;
    --border-radius: 8px;
    --box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
body {
    font-family: 'Roboto', sans-serif;
    background-color: var(--background-color);
    color: var(--text-color);
    line-height: 1.4;
    
}
.container {
    max-width: 900px;
    margin: 0 auto;
    padding: 10px;
}
header {
    background-color: var(--primary-color);
    color: white;
    padding: 20px 0;
    text-align: center;
    border-bottom: 3px solid var(--accent-color);
}
h1 {
    font-size: 2rem;
    margin-bottom: 5px;
    font-weight: 700;
}
.info-group {
    background: var(--card-background);
    padding: 20px;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    margin-bottom: 20px;
}
.info-group h2 {
    color: var(--secondary-color);
    border-bottom: 2px solid var(--accent-color);
    padding-bottom: 10px;
    margin-bottom: 15px;
    font-size: 1.6rem;
}
.info-item {
    margin-bottom: 10px;
    display: grid;
    grid-template-columns: 50px 200px 700px;
    align-items: center;
    justify-content: space-between;
}
.info-item i {
    margin-right: 10px;
    color: var(--accent-color);
    font-size: 1rem;
}
.info-item strong {
    font-weight: 700;
}
.logout-btn {
    display: inline-block;
    background: var(--accent-color);
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: var(--border-radius);
    transition: background 0.3s ease, transform 0.3s ease;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-align: center;
    margin-top: 15px;
}
.logout-btn:hover {
    background: #218c55;
    transform: translateY(-2px);
}
hr {
    border: none;
    border-top: 1px solid #ddd;
    margin: 15px 0;
}
  </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Welcome, <?php echo htmlspecialchars($user_data['name']); ?>!</h1>
        </div>
    </header>
    <div class="container">
        <div class="info-group">
            <h2><i class="fas fa-user"></i> Personal Information</h2>
            <div class="info-item"><i class="fas fa-user-circle"></i><strong>Name:</strong> <?php echo htmlspecialchars($user_data['name']); ?></div>
            <div class="info-item"><i class="fas fa-birthday-cake"></i><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user_data['dob']); ?></div>
            <div class="info-item"><i class="fas fa-venus-mars"></i><strong>Gender:</strong> <?php echo htmlspecialchars($user_data['gender']); ?></div>
            <div class="info-item"><i class="fas fa-envelope"></i><strong>Email:</strong> <?php echo htmlspecialchars($user_data['email']); ?></div>
            <div class="info-item"><i class="fas fa-phone"></i><strong>Phone:</strong> <?php echo htmlspecialchars($user_data['phone']); ?></div>
            <div class="info-item"><i class="fas fa-mobile-alt"></i><strong>Mobile:</strong> <?php echo htmlspecialchars($user_data['mobile']); ?></div>
            <div class="info-item"><i class="fas fa-map-marker-alt"></i><strong>Address:</strong> 
                <?php echo htmlspecialchars($user_data['building_no'] . ', ' . $user_data['street_no'] . ', ' . $user_data['area_name'] . ', ' . $user_data['district']); ?>
            </div>
            <div class="info-item"><i class="fas fa-id-card"></i><strong>NID No:</strong> <?php echo htmlspecialchars($user_data['nid_no']); ?></div>
        </div>
        <div class="info-group">
            <h2><i class="fas fa-parking"></i> Parking Space Information</h2>
            <div class="info-item"><i class="fas fa-car"></i><strong>Number of Parking Spaces:</strong> <?php echo htmlspecialchars($user_data['num_parking_spaces']); ?></div>
            <div class="info-item"><i class="fas fa-money-bill-wave"></i><strong>Expected Rent:</strong> <?php echo htmlspecialchars($user_data['expected_rent']); ?></div>
            <div class="info-item"><i class="fas fa-shield-alt"></i><strong>Security Features:</strong> <?php echo htmlspecialchars($user_data['security_features']); ?></div>
            <div class="info-item"><i class="fas fa-info-circle"></i><strong>Description:</strong> <?php echo htmlspecialchars($user_data['description']); ?></div>
            <div class="info-item"><i class="fas fa-exclamation-triangle"></i><strong>Constraints:</strong> <?php echo htmlspecialchars($user_data['constraints']); ?></div>
        </div>
        <div class="info-group">
            <h2><i class="fas fa-book"></i> Booking Information</h2>
            <?php if (!empty($bookings_data)) { ?>
                <?php foreach ($bookings_data as $booking) { ?>
                    <div class="info-item">
                        <i class="fas fa-money-bill-wave"></i><strong>Total Price:</strong> <?php echo htmlspecialchars($booking['totalPrice']); ?> BDT
                    </div>
                    <div class="info-item">
                        <i class="fas fa-clock"></i><strong>Number of Hours:</strong> <?php echo htmlspecialchars($booking['hours']); ?> hours
                    </div>
                    <div class="info-item">
                        <i class="fas fa-id-badge"></i><strong>Garage ID:</strong> <?php echo htmlspecialchars($booking['garageId']); ?>
                    </div>
                    <hr>
                <?php } ?>
            <?php } else { ?>
                <p>No bookings found for your garage.</p>
            <?php } ?>
        </div>
        <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
    </div>
</body>
</html>
