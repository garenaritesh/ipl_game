<!-- Session Check -->
<?php

session_start();

include("admin/db.php");

if (!$_SESSION['logins']) {
    header("location:users/login.php");
}

// Current User 
$user = $_SESSION['logins'];
$user_data = mysqli_fetch_assoc(mysqli_query($db, "select * from teams where team_email = '$user'"));


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Educate.com </title>
    <link rel="stylesheet" href="config/style.css">
    <!-- <link rel="stylesheet" href="../css/index.css"> -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <!-- Body content here -->

    <!-- Header Of Webapp -->

    <nav>
        <div class="logo">
            <h3>Auction<span>IPL</span></h3>
        </div>

        <ul class="nav_list">
            <li>Home</li>
            <li onclick="location.href = 'my_team.php'">My Team</li>
        </ul>

        <!-- Account Login or Signup System Here -->

        <?php

        if (!$_SESSION['logins']) {

            ?>
            <ul class="users_list">
                <!-- <li>login</li> -->
                <li onclick="location.href = '../public/users/register.php'">Create Account</li>
            </ul>
        <?php } else {

            ?>

            <ul class="users_list">
                <!-- <li>login</li> -->
                <!-- <li onclick="location.href = '../admin/admin_panel/dashboard.php'" class="edu_dash">Educator Dashboard</li> -->
                <li onclick="location.href = '#'" class="user_icon"><img src="admin/images/teams/<?php echo $user_data['team_logo']?>" alt=""></li>
            </ul>

            <?php
        }

        ?>



    </nav>






</body>

</html>