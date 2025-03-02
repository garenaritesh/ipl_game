<!-- SESSIOn -->
<?php
session_start();
include('../db.php');
$user = $_SESSION['logins'];

if (isset($_POST['reset_pass'])) {
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> OTP Verification </title>
    <link rel="stylesheet" href="../css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <!-- Body Content Here -->

    <!-- Header -->
    <nav>
        <div class="logo">
            <h1>user<span>Auth</span> </h1>
        </div>
        <ul>
            <li onclick="location.href='register.php'">Create Account</li>
        </ul>
    </nav>


    <!-- Main Container Here -->

    <div class="container">
        <form action="#" method="post" class="form_container">
            <h2>Verify Email</h2>
            <p><?php echo @$message; ?></p>
            <input type="text" placeholder="OTP" name="otp" required>

            <button name="reset_pass">Submit</button>
        </form>
    </div>

    <!-- Javascript contente here -->

</body>

</html>