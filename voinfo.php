<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vehicle_owner_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM vehicle_owners WHERE id = $user_id";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $user_data = $result->fetch_assoc();
} else {
    die("User not found");
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Owner Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
        }
        .info-group {
            margin-bottom: 20px;
        }
        .info-group h2 {
            color: #444;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .info-item {
            margin-bottom: 10px;
        }
        .info-item strong {
            display: inline-block;
            width: 200px;
            color: #666;
        }
        .logout-btn {
            display: inline-block;
            background: #d9534f;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout-btn:hover {
            background: #c9302c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($user_data['name']); ?>!</h1>
        
        <div class="info-group">
            <h2>Personal Information</h2>
            <div class="info-item"><strong>Name:</strong> <?php echo htmlspecialchars($user_data['name']); ?></div>
            <div class="info-item"><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user_data['dob']); ?></div>
            <div class="info-item"><strong>Gender:</strong> <?php echo htmlspecialchars($user_data['gender']); ?></div>
            <div class="info-item"><strong>Email:</strong> <?php echo htmlspecialchars($user_data['email']); ?></div>
            <div class="info-item"><strong>Phone:</strong> <?php echo htmlspecialchars($user_data['phone']); ?></div>
            <div class="info-item"><strong>Mobile:</strong> <?php echo htmlspecialchars($user_data['mobile']); ?></div>
            <div class="info-item"><strong>Address:</strong> <?php echo htmlspecialchars($user_data['address']); ?></div>
        </div>
        
        <div class="info-group">
            <h2>License and NID Information</h2>
            <div class="info-item"><strong>Driving License No:</strong> <?php echo htmlspecialchars($user_data['licence_no']); ?></div>
            <div class="info-item"><strong>NID No:</strong> <?php echo htmlspecialchars($user_data['nid_no']); ?></div>
        </div>
        
        <div class="info-group">
            <h2>Vehicle Information</h2>
            <div class="info-item"><strong>Vehicle Type:</strong> <?php echo htmlspecialchars($user_data['vehicle_type']); ?></div>
            <div class="info-item"><strong>Vehicle Model:</strong> <?php echo htmlspecialchars($user_data['vehicle_model']); ?></div>
            <div class="info-item"><strong>Registration No:</strong> <?php echo htmlspecialchars($user_data['vehicle_registration']); ?></div>
            <div class="info-item"><strong>Plate No:</strong> <?php echo htmlspecialchars($user_data['vehicle_plate']); ?></div>
            <div class="info-item"><strong>Chassis No/VIN:</strong> <?php echo htmlspecialchars($user_data['vehicle_chassis']); ?></div>
            <div class="info-item"><strong>Description:</strong> <?php echo htmlspecialchars($user_data['description']); ?></div>
        </div>
        
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
