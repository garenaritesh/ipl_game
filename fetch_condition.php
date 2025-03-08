<?php
session_start();
include("admin/db.php");

if (!$_SESSION['team_auction_panel_login']) {
    header("location:index.php");
}

// Current User 
$user = $_SESSION['team_auction_panel_login'];
$user_data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM teams WHERE team_email = '$user'"));
$current_team_id = $user_data['team_id'];



// Fetch latest bid amount and team ID
$query = "SELECT * from auction_panel where team_id = '$current_team_id'";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) > 0) {
    $bid = mysqli_fetch_assoc($result);
    $team_budget = $bid['budget'];

    // Fetch Current Team Squad Members mean Count
    $count_squad_query = "select count(*) as total_players from live_auction where team_id = '$current_team_id'";
    $squad_data = mysqli_fetch_assoc(mysqli_query($db, $count_squad_query));
    $squad_members = $squad_data['total_players'];


    echo json_encode([
        "status" => "success",
        "data" => [
            "team_budget" => $team_budget,
            "squad_members" => $squad_members
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "No bid data available"]);
}
?>
