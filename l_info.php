<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "safeParking";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM garage_owners WHERE id = $user_id";
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
    <title>Garage Owner Information</title>
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
            <div class="info-item"><strong>Address:</strong> 
                <?php echo htmlspecialchars($user_data['building_no'] . ', ' . $user_data['street_no'] . ', ' . $user_data['area_name'] . ', ' . $user_data['district'] . ', ' . $user_data['post_code'] . ', ' . $user_data['country']); ?>
            </div>
            <div class="info-item"><strong>NID No:</strong> <?php echo htmlspecialchars($user_data['nid_no']); ?></div>
        </div>
        <div class="info-group">
            <h2>Parking Space Information</h2>
            <?php
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql_parking = "SELECT * FROM garage_owners WHERE id = $user_id";
            $result_parking = $conn->query($sql_parking);
            
            if ($result_parking === false) {
                die("Error fetching parking space information: " . $conn->error);
            }
            if ($result_parking->num_rows > 0) {
                while ($parking_data = $result_parking->fetch_assoc()) {
                    echo '<div class="info-item"><strong>Number of Parking Spaces:</strong> ' . htmlspecialchars($parking_data['num_parking_spaces']) . '</div>';
                    echo '<div class="info-item"><strong>Expected Rent:</strong> ' . htmlspecialchars($parking_data['expected_rent']) . '</div>';
                    echo '<div class="info-item"><strong>Security Features:</strong> ' . htmlspecialchars($parking_data['security_features']) . '</div>';
                    echo '<div class="info-item"><strong>Description:</strong> ' . htmlspecialchars($parking_data['description']) . '</div>';
                    echo '<div class="info-item"><strong>Constraints:</strong> ' . htmlspecialchars($parking_data['constraints']) . '</div>';
                }
            } else {
                echo '<div class="info-item"><strong>No parking spaces found.</strong></div>';
            }
            $conn->close();
            ?>
        </div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
