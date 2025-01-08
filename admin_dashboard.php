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
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
$sql = "SELECT b.garageId, g.name AS garage_owner_name, v.name AS vehicle_owner_name, 
               b.totalPrice, g.email AS garage_email, v.email AS vehicle_email, 
               g.phone AS garage_phone, v.phone AS vehicle_phone 
        FROM bookings b 
        JOIN garage_owners g ON b.garageId = g.garageId 
        JOIN vehicle_owners v ON b.vehicle_owner_id = v.id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .logout-btn {
            display: inline-block;
            background: #e74c3c;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <a href="logout.php" class="logout-btn">Logout</a>
    <table>
        <thead>
            <tr>
                <th>Garage ID</th>
                <th>Garage Owner Name</th>
                <th>Vehicle Owner Name</th>
                <th>Total Price (BDT)</th>
                <th>Garage Email</th>
                <th>Vehicle Owner Email</th>
                <th>Garage Phone</th>
                <th>Vehicle Owner Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['garageId']); ?></td>
                        <td><?php echo htmlspecialchars($row['garage_owner_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['vehicle_owner_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['totalPrice']); ?></td>
                        <td><?php echo htmlspecialchars($row['garage_email']); ?></td>
                        <td><?php echo htmlspecialchars($row['vehicle_email']); ?></td>
                        <td><?php echo htmlspecialchars($row['garage_phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['vehicle_phone']); ?></td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="8">No bookings found.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
<?php
$conn->close();
?>
