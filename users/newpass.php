<!-- SESSIOn -->
<?php


include("../db.php");
session_start();


if(isset($_REQUEST['change_pass'])){

    $id = $_REQUEST['change_pass'];

    $sql = "select * from users where id = '$id'";
    $res = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($res);

}

// Update Their Password 

if(isset($_REQUEST['reset_pass'])) {

    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    $sql = "update users set password='$password' where email = '$email'";
    $update_query = mysqli_query($db,$sql);
    header("location:login.php");


}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> New Password </title>
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
            <h2>New Password</h2>
            <input type="email" name="email" value="<?php echo $row['email']?>" required placeholder="email" readonly>
            <input type="text" name="password" required placeholder="New Password">
            <input type="password" required placeholder="Confirm Password">
            <button name="reset_pass">Submit</button>
        </form>
    </div>

    <!-- Javascript contente here -->

</body>

</html>