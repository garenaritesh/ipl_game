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
$query = "SELECT bid_amount, bid_team_id,retain_team FROM selected_auction_player ORDER BY player_id DESC LIMIT 1";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) > 0) {
    $bid = mysqli_fetch_assoc($result);
    $bid_amount = $bid['bid_amount'];
    $team_budget = $bid['bid_team_id'];
    $team_id = $bid['bid_team_id'];
    $retain = $bid['retain_team'];

    // Get team logo
    $teamQuery = "SELECT team_logo FROM teams WHERE team_id = '$team_id' LIMIT 1";
    $teamResult = mysqli_query($db, $teamQuery);
    $teamData = mysqli_fetch_assoc($teamResult);
    $team_logo = $teamData['team_logo'] ?? "default_logo.png";

    // Get Team current budget
    $team_budget_query = "select budget from auction_panel where team_id = '$current_team_id'";
    $team_budget_result = mysqli_query($db, $team_budget_query);
    $team_budget_data = mysqli_fetch_assoc($team_budget_result);
    $team_budget_amount = $team_budget_data['budget'] ?? 0;

    // Fetch Current Team Bid Budget 
    $bid_team_budget_query = "select * from auction_panel where team_id = '$team_id'";
    $bid_team_budget_data = mysqli_fetch_assoc(mysqli_query($db, $bid_team_budget_query));
    $bid_team_budget = $bid_team_budget_data['budget'];


    // Fetch Current Team Squad Members mean Count
    $count_squad_query = "select count(*) as total_players from live_auction where team_id = '$current_team_id'";
    $squad_data = mysqli_fetch_assoc(mysqli_query($db, $count_squad_query));
    $squad_members = $squad_data['total_players'];


    echo json_encode([
        "status" => "success",
        "data" => [
            "bid_amount" => $bid_amount,
            "team_logo" => "admin/images/teams/" . $team_logo,
            "team_id" => $team_id,
            "budget" => $team_budget_amount,
            "retain" => $retain,
            "bid_team_budget" => $bid_team_budget,
            "squad_members" => $squad_members
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "No bid data available"]);
}
?>