<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "safeparking";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$garage_data = [];
$vehicle_data = [];
$booking_data = [];
$garage_sql = "SELECT id AS garage_id, name AS garage_owner_name, email AS garage_email, phone AS garage_phone FROM garage_owners";
$garage_result = $conn->query($garage_sql);
if ($garage_result && $garage_result->num_rows > 0) {
    while ($row = $garage_result->fetch_assoc()) {
        $garage_data[] = $row;
    }
}
$vehicle_sql = "SELECT id AS vehicle_owner_id, name AS vehicle_owner_name, email AS vehicle_email, phone AS vehicle_phone FROM vehicle_owners";
$vehicle_result = $conn->query($vehicle_sql);
if ($vehicle_result && $vehicle_result->num_rows > 0) {
    while ($row = $vehicle_result->fetch_assoc()) {
        $vehicle_data[] = $row;
    }
}
$booking_sql = "SELECT garageId, hours, totalPrice FROM bookings";
$booking_result = $conn->query($booking_sql);
if ($booking_result && $booking_result->num_rows > 0) {
    while ($row = $booking_result->fetch_assoc()) {
        $booking_data[] = $row;
    }
}
$conn->close();
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
            margin: 0;
            padding: 15rem;
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        .dashboard {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 100%;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 10px;
            }
            table {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <h2>Admin Dashboard</h2>
    <h3>Garage Owners</h3>
    <table>
        <tr>
            <th>Garage ID</th>
            <th>Garage Owner Name</th>
            <th>Garage Email</th>
            <th>Garage Phone</th>
        </tr>
        <?php if (!empty($garage_data)): ?>
            <?php foreach ($garage_data as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['garage_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['garage_owner_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['garage_email']); ?></td>
                    <td><?php echo htmlspecialchars($row['garage_phone']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">No garage owners found.</td></tr>
        <?php endif; ?>
    </table>
    <h3>Vehicle Owners</h3>
    <table>
        <tr>
            <th>Vehicle Owner ID</th>
            <th>Vehicle Owner Name</th>
            <th>Vehicle Owner Email</th>
            <th>Vehicle Owner Phone</th>
        </tr>
        <?php if (!empty($vehicle_data)): ?>
            <?php foreach ($vehicle_data as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['vehicle_owner_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['vehicle_owner_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['vehicle_email']); ?></td>
                    <td><?php echo htmlspecialchars($row['vehicle_phone']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">No vehicle owners found.</td></tr>
        <?php endif; ?>
    </table>
    <h3>Bookings</h3>
    <table>
        <tr>
            <th>Garage ID</th>
            <th>Hours</th>
            <th>Total Price</th>
        </tr>
        <?php if (!empty($booking_data)): ?>
            <?php foreach ($booking_data as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['garageId']); ?></td>
                    <td><?php echo htmlspecialchars($row['hours']); ?></td>
                    <td><?php echo htmlspecialchars($row['totalPrice']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3">No bookings found.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>