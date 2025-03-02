<?php
session_start();
include('../db.php');
$user = $_SESSION['logins'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userOtp = $_POST['otp'];
    if ($userOtp == $_SESSION['otp']) {
        $message = "OTP SUCCESSFULLY";

        $sql = "update users set verify='verified' where email = '$user'";
        mysqli_query($db, $sql);
        header("location:../index.php");
    } else {
        $message = "Enter Valid OTP";
    }
}
?>