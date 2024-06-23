<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vehicle_owner_db";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully or already exists<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select the database
$conn->select_db($dbname);

// Create table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS vehicle_owners (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    dob DATE,
    gender VARCHAR(10),
    licence_no VARCHAR(50),
    email VARCHAR(100),
    phone VARCHAR(20),
    mobile VARCHAR(20),
    address TEXT,
    nid_no VARCHAR(50),
    nid_photo_front VARCHAR(255),
    nid_photo_back VARCHAR(255),
    vehicle_type VARCHAR(50),
    vehicle_model VARCHAR(50),
    vehicle_registration VARCHAR(50),
    vehicle_plate VARCHAR(50),
    vehicle_chassis VARCHAR(100),
    description TEXT,
    password VARCHAR(255),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully or already exists<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = $conn->real_escape_string($_POST['name'] ?? '');
    $dob = $conn->real_escape_string($_POST['dob'] ?? '');
    $gender = $conn->real_escape_string($_POST['gender'] ?? '');
    $licence = $conn->real_escape_string($_POST['licence'] ?? '');
    $email = $conn->real_escape_string($_POST['email'] ?? '');
    $phone = $conn->real_escape_string($_POST['phone'] ?? '');
    $mobile = $conn->real_escape_string($_POST['mobile'] ?? '');
    $address = $conn->real_escape_string($_POST['address'] ?? '');
    $nid = $conn->real_escape_string($_POST['nid'] ?? '');
    $vehicle_type = $conn->real_escape_string($_POST['vehicle-type'] ?? '');
    $vehicle_model = $conn->real_escape_string($_POST['vehicle-model'] ?? '');
    $vehicle_registration = $conn->real_escape_string($_POST['vehicle-registration'] ?? '');
    $vehicle_plate = $conn->real_escape_string($_POST['vehicle-plate'] ?? '');
    $vehicle_chassis = $conn->real_escape_string($_POST['vehicle-chassis'] ?? '');
    $description = $conn->real_escape_string($_POST['description'] ?? '');
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';

    // Handle file uploads (NID photos and vehicle photos)
    $nid_photo_front = uploadFile('nid-photo-front');
    $nid_photo_back = uploadFile('nid-photo-back');
    $vehicle_photos = uploadMultipleFiles('vehicle-photos');

    // Insert data into the database
    $sql = "INSERT INTO vehicle_owners (name, dob, gender, licence_no, email, phone, mobile, address, nid_no, nid_photo_front, nid_photo_back, vehicle_type, vehicle_model, vehicle_registration, vehicle_plate, vehicle_chassis, description, password)
    VALUES ('$name', '$dob', '$gender', '$licence', '$email', '$phone', '$mobile', '$address', '$nid', '$nid_photo_front', '$nid_photo_back', '$vehicle_type', '$vehicle_model', '$vehicle_registration', '$vehicle_plate', '$vehicle_chassis', '$description', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        // Redirect to login page after successful signup
        header("Location: voLoginPage.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

function uploadFile($inputName) {
    $targetDir = __DIR__ . "/uploads/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    
    if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] == 0) {
        $targetFile = $targetDir . basename($_FILES[$inputName]["name"]);
        if (move_uploaded_file($_FILES[$inputName]["tmp_name"], $targetFile)) {
            return "uploads/" . basename($_FILES[$inputName]["name"]);
        }
    }
    return "";
}

function uploadMultipleFiles($inputName) {
    $targetDir = __DIR__ . "/uploads/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    
    $uploadedFiles = [];
    if (isset($_FILES[$inputName]['name'])) {
        foreach ($_FILES[$inputName]['tmp_name'] as $key => $tmp_name) {
            if ($_FILES[$inputName]['error'][$key] == 0) {
                $targetFile = $targetDir . basename($_FILES[$inputName]["name"][$key]);
                if (move_uploaded_file($tmp_name, $targetFile)) {
                    $uploadedFiles[] = "uploads/" . basename($_FILES[$inputName]["name"][$key]);
                }
            }
        }
    }
    return implode(",", $uploadedFiles);
}
?>