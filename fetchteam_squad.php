<?php
session_start();
include("admin/db.php");

if (!$_SESSION['team_auction_panel_login']) {
    header("location:index.php");
}

// Current User 
$user = $_SESSION['team_auction_panel_login'];
$user_data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM teams WHERE team_email = '$user'"));
$team_id = $user_data['team_id'];

$query = mysqli_query($db, "SELECT COUNT(*) AS total_players FROM live_auction where team_id = '$team_id'");
$result = mysqli_fetch_assoc($query);
echo $result['total_players'];
?>