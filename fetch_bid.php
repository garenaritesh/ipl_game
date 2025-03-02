<?php
include("admin/db.php");

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
    $team_budget_query = "select budget from auction_panel where team_id = '$team_budget'";
    $team_budget_result = mysqli_query($db, $team_budget_query);
    $team_budget_data = mysqli_fetch_assoc($team_budget_result);
    $team_budget_amount = $team_budget_data['budget'] ?? 0;

    echo json_encode([
        "status" => "success",
        "data" => [
            "bid_amount" => $bid_amount,
            "team_logo" => "admin/images/teams/" . $team_logo,
            "team_id" => $team_id,
            "budget" => $team_budget_amount,
            "retain" => $retain
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "No bid data available"]);
}
?>