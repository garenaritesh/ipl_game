<!-- SESSIOn -->
<?php


include("../admin/db.php");
session_start();

if (isset($_POST['logins'])) {

    $email = $_POST['team_email'];
    $password = $_POST['team_pass'];

    $sql = "select * from teams where team_email='$email' and team_pass='$password'";
    $res = mysqli_query($db, $sql);
    if (mysqli_num_rows($res)) {
        $_SESSION['logins'] = $email;
        echo "<h1>Login Successfully</h1>";
        header("location:../index.php");
    } else {

        @$error_msg = "Email and Password doesn't match";

    }

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sign In </title>
    <link rel="stylesheet" href="css/style.css">
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
            <h2>SIGN IN</h2>
            <p class="login_error"> <?php echo @$error_msg;?> </p>
            <input type="email" name="team_email" required placeholder="email">
            <input type="text" name="team_pass" required placeholder="password">
            <button name="logins">SIGN IN</button>
            <p class="desc"><a href="forgat.php">forgat password?</a></p>
        </form>
    </div>

    <!-- Javascript contente here -->


</body>

</html>