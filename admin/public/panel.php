<?php

include("../db.php");
session_start();

if (!$_SESSION['admin_login']) {
    header("location:login_admin.php");
}

$admin = $_SESSION['admin_login'];


$sql = "select * from admin";
$res = mysqli_query($db, $sql);
$admins_data = mysqli_fetch_assoc($res);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PassMate Admin Panel</title>

    <!-- Stylling File Link Here -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../media/media.css">

    <!-- Icons Link Here -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />

</head>

<body>

 

    <!-- Admin Panel Structure Here -->

    <!-- Admin Panel Nav -->
    <nav>

        <div class="logo">
            <h1>IPL</h1>
            <span>auction panel</span>
        </div>

        <div class="info">
            <p><?php echo $admin; ?></p>
            <a href="logout_admin.php">Logout</a>
        </div>

    </nav>
    <?php
    if ($admin == 'auctionbapp') {
        ?>
        <!-- Panel Structure -->
        <div class="panel">

            <div class="left">
                <div class="menu">
                    <a href="dashboard.php"><i class='bx bxs-dashboard'></i><p>Dashboard</p></a>
                    <a href="add_player.php"><i class='bx bx-user-plus' ></i><p>Add Player</p></a>
                    <a href="teams.php"><i class='bx bxl-graphql'></i><p> Teams </p></a>
                    <a href="auction_data.php"><i class='bx bxs-data'></i><p>Auction Data</p></a>
                    <a href="manage_auction.php"><i class='bx bxs-castle'></i><p>Start Auction</p></a>
                    <a href="players.php"><i class='bx bx-user-check'></i><p>Players</p></a>
                    <a href="../../team_selection.php" target="_blank"><span><img src="../assets/hand_wave.png" style="width: 25px;" alt=""></span>Team Selection</a>
            
                </div>

            </div>

            <div class="right">

                <!-- Panel Content Here -->




                <!-- Javascript file link here -->

            <?php } else { ?>
                <!-- Panel Structure -->
                <div class="panel" id="panel_not">

                    <div class="left">


                    </div>

                    <div class="right">
                    <?php } ?>




</body>

</html>