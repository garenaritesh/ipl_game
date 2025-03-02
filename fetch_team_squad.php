<?php
include("db.php");
session_start();

if (!isset($_SESSION['team_login_auction'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit;
}

$user = $_SESSION['team_login_auction'];
$user_data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM teams WHERE team_email = '$user'"));
$team_id = $user_data['team_id'];

$response = ["status" => "success", "batsmen" => "", "bowlers" => "", "all_rounders" => ""];

// Fetch Batsmen
$fetch_batsmen = mysqli_query($db, "SELECT * FROM live_auction WHERE player_cate = 'Bat' AND team_id = '$team_id'");
while ($row = mysqli_fetch_assoc($fetch_batsmen)) {
    $response['batsmen'] .= "<div class='player_box'><div class='player_info'><h5>{$row['player_name']}</h5></div></div>";
}

// Fetch Bowlers
$fetch_bowlers = mysqli_query($db, "SELECT * FROM live_auction WHERE player_cate = 'Bow' AND team_id = '$team_id'");
while ($row = mysqli_fetch_assoc($fetch_bowlers)) {
    $response['bowlers'] .= "<div class='player_box'><div class='player_info'><h5>{$row['player_name']}</h5></div></div>";
}

// Fetch All-Rounders
$fetch_ar = mysqli_query($db, "SELECT * FROM live_auction WHERE player_cate = 'AR' AND team_id = '$team_id'");
while ($row = mysqli_fetch_assoc($fetch_ar)) {
    $response['all_rounders'] .= "<div class='player_box'><div class='player_info'><h5>{$row['player_name']}</h5></div></div>";
}

echo json_encode($response);
?>