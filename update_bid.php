<?php
include("admin/db.php");
session_start();

if (!isset($_SESSION['team_auction_panel_login'])) {
    echo json_encode(["status" => "error", "message" => "Not logged in"]);
    exit();
}

$team_email = $_SESSION['team_auction_panel_login'];

// Get team ID from `teams` table
$teamQuery = mysqli_query($db, "SELECT team_id FROM teams WHERE team_email = '$team_email'");
$teamData = mysqli_fetch_assoc($teamQuery);
$team_id = $teamData['team_id'];

// Get current bid data
$bidQuery = mysqli_query($db, "SELECT bid_amount FROM selected_auction_player ORDER BY player_id DESC LIMIT 1");
$bidData = mysqli_fetch_assoc($bidQuery);
$bid_amount = floatval($bidData['bid_amount']);

// Increase bid amount (increment by 0.5 Cr)
$new_bid = $bid_amount + 0.5;

// Update the bid amount and team ID in the database
$updateBid = mysqli_query($db, "UPDATE selected_auction_player SET bid_amount = '$new_bid', bid_team_id = '$team_id'");

if ($updateBid) {
    echo json_encode(["status" => "success", "new_bid" => $new_bid, "team_id" => $team_id]);
} else {
    echo json_encode(["status" => "error", "message" => "Bid update failed"]);
}
?>
