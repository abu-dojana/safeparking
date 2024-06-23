<?php
session_start();
session_destroy();
header("Location: voLoginPage.php");
exit();
?>