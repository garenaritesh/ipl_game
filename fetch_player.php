<?php
include("admin/db.php");

$query = "SELECT * FROM selected_auction_player ORDER BY player_id DESC LIMIT 1";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) > 0) {
    $player = mysqli_fetch_assoc($result);
    echo json_encode(["status" => "success", "data" => $player]);
} else {
    echo json_encode(["status" => "error", "message" => "Auction has started. Please wait for player 😊"]);
}
?>