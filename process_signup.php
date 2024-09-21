<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "safeparking";
$conn = new mysqli($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully<br>";
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully or already exists<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}
$conn->select_db($dbname);
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
    echo "Table vehicle_owners created successfully or already exists<br>";
} else {
    echo "Error creating table vehicle_owners: " . $conn->error . "<br>";
}
$sql = "CREATE TABLE IF NOT EXISTS garage_owners (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    dob DATE,
    gender VARCHAR(10),
    email VARCHAR(100),
    phone VARCHAR(20),
    mobile VARCHAR(20),
    address TEXT,
    building_no VARCHAR(50),
    street_no VARCHAR(50),
    area_name VARCHAR(50),
    district VARCHAR(50),
    latitude FLOAT,
    longitude FLOAT,
    nid_no VARCHAR(50),
    nid_photo_front VARCHAR(255),
    nid_photo_back VARCHAR(255),
    parking_space_photos TEXT,
    num_parking_spaces INT,
    expected_rent INT,
    security_features TEXT,
    description TEXT,
    constraints TEXT,
    password VARCHAR(255),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    echo "Table garage_owners created successfully or already exists<br>";
} else {
    echo "Error creating table garage_owners: " . $conn->error . "<br>";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['form_type']) && $_POST['form_type'] == 'vehicle_owner') {
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
        $nid_photo_front = uploadFile('nid-photo-front');
        $nid_photo_back = uploadFile('nid-photo-back');
        $vehicle_photos = uploadMultipleFiles('vehicle-photos');
        $sql = "INSERT INTO vehicle_owners (name, dob, gender, licence_no, email, phone, mobile, address, nid_no, nid_photo_front, nid_photo_back, vehicle_type, vehicle_model, vehicle_registration, vehicle_plate, vehicle_chassis, description, password)
        VALUES ('$name', '$dob', '$gender', '$licence', '$email', '$phone', '$mobile', '$address', '$nid', '$nid_photo_front', '$nid_photo_back', '$vehicle_type', '$vehicle_model', '$vehicle_registration', '$vehicle_plate', '$vehicle_chassis', '$description', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "New vehicle owner record created successfully";
            header("Location: voLoginPage.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'garage_owner') {
        $name = $conn->real_escape_string($_POST['name'] ?? '');
        $dob = $conn->real_escape_string($_POST['dob'] ?? '');
        $gender = $conn->real_escape_string($_POST['gender'] ?? '');
        $email = $conn->real_escape_string($_POST['email'] ?? '');
        $phone = $conn->real_escape_string($_POST['phone'] ?? '');
        $mobile = $conn->real_escape_string($_POST['mobile'] ?? '');
        $address = $conn->real_escape_string($_POST['address'] ?? '');
        $building_no = $conn->real_escape_string($_POST['building_no'] ?? '');
        $street_no = $conn->real_escape_string($_POST['street_no'] ?? '');
        $area_name = $conn->real_escape_string($_POST['area_name'] ?? '');
        $district = $conn->real_escape_string($_POST['district'] ?? '');
        $latitude = $conn->real_escape_string($_POST['latitude'] ?? 0);
        $longitude = $conn->real_escape_string($_POST['longitude'] ?? 0);
        $nid = $conn->real_escape_string($_POST['nid'] ?? '');
        $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
        $nid_photo_front = uploadFile('nid-photo-front');
        $nid_photo_back = uploadFile('nid-photo-back');
        $parking_space_photos = uploadMultipleFiles('parking-space-photos');
        $num_parking_spaces = $conn->real_escape_string($_POST['num_parking_spaces'] ?? 0);
        $expected_rent = $conn->real_escape_string($_POST['expected_rent'] ?? 0);
        $security_features = $conn->real_escape_string($_POST['security_features'] ?? '');
        $description = $conn->real_escape_string($_POST['description'] ?? '');
        $constraints = $conn->real_escape_string($_POST['constraints'] ?? '');
        $sql = "INSERT INTO garage_owners (name, dob, gender, email, phone, mobile, address, building_no, street_no, area_name, district, latitude, longitude, nid_no, nid_photo_front, nid_photo_back, parking_space_photos, num_parking_spaces, expected_rent, security_features, description, constraints, password)
        VALUES ('$name', '$dob', '$gender', '$email', '$phone', '$mobile', '$address', '$building_no', '$street_no', '$area_name', '$district', '$latitude', '$longitude', '$nid', '$nid_photo_front', '$nid_photo_back', '$parking_space_photos', '$num_parking_spaces', '$expected_rent', '$security_features', '$description', '$constraints', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "New garage owner record created successfully";
            header("Location: landlordLoginPage.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
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
    if (isset($_FILES[$inputName])) {
        foreach ($_FILES[$inputName]['tmp_name'] as $key => $tmpName) {
            $targetFile = $targetDir . basename($_FILES[$inputName]["name"][$key]);
            if (move_uploaded_file($tmpName, $targetFile)) {
                $uploadedFiles[] = "uploads/" . basename($_FILES[$inputName]["name"][$key]);
            }
        }
    }
    return json_encode($uploadedFiles);
}
?>
