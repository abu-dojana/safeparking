<?php
session_start();
$error_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "safeparking";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $email_or_phone = $conn->real_escape_string($_POST['email_or_phone']);
    $password_input = $_POST['password'];
    $sql = "SELECT id, name, password FROM garage_owners WHERE email = '$email_or_phone' OR phone = '$email_or_phone' OR mobile = '$email_or_phone'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password_input, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            header("Location: landlordDashboard.php");
            exit();
        } else {
            $error_message = "Invalid email/phone or password";
        }
    } else {
        $error_message = "Invalid email/phone or password";
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="landlordLoginPage.css">
    <title>Landlord Login</title>
</head>
<body>
    <div class="login-page">
        <img src="images/garage.jpg" alt="Background" class="background-image">
        <div class="form-container">
            <p class="login">Login</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label class="email-or-phone" for="email_or_phone">Email Address / Phone Number</label>
                <input type="text" id="email_or_phone" name="email_or_phone" class="input-field" placeholder="Enter email address or phone number" required>
                <label class="password" for="password">Password</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" class="input-field" placeholder="Enter your password" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility()">Show</span>
                </div>
                <?php if (!empty($error_message)): ?>
                    <span style="color:red;"><?php echo htmlspecialchars($error_message); ?></span>
                <?php endif; ?>

                <button type="submit" class="login-button">LOGIN</button>
            </form>
            <p class="forgot-password"><a href="#">Forgot password?</a></p>
            <p class="dont-have-an-account-sign-up">Don’t have an account?<a href="landlordSignupPage.html"><strong> Signup</strong></a></p>
        </div>
    </div>
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var toggleButton = document.querySelector(".toggle-password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleButton.textContent = "Hide";
                toggleButton.style.fontWeight = "bold";
            } else {
                passwordField.type = "password";
                toggleButton.textContent = "Show";
                toggleButton.style.fontWeight = "bold";
            }
        }
    </script>
</body>
</html>
