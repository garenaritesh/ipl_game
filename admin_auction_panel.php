<?php



session_start();

include("admin/db.php");

if (!$_SESSION['admin_auction_panel_login']) {
    header("location:admin_auction_panel_login.php");
}

// // Current User 
// $user = $_SESSION['admin_auction_panel_login'];
// $user_data = mysqli_fetch_assoc(mysqli_query($db, "select * from teams where team_email = '$user'"));


// Auction Login



// Select PLayer For Auction
if (isset($_REQUEST['new_player'])) {

    $remove_last_player = mysqli_query($db, "TRUNCATE TABLE selected_auction_player");
    $select_player = mysqli_query($db, "select * from live_players order by rand() limit 1");

    if (mysqli_num_rows($select_player) > 0) {
        $row = mysqli_fetch_assoc($select_player);
        $player_id = $row['player_id'];
        $player_name = $row['player_name'];
        $player_pic = $row['player_pic'];
        $base_price = $row['base_price'];
        $category = $row['category'];
        $bid_amount = $row['base_price'];
        $retain = $row['retain_team'];

        // Insert New Player Data In Auction Player
        $insert_player = mysqli_query($db, "insert into selected_auction_player(player_id,player_name,player_pic,base_price,category,bid_amount,retain_team) values('$player_id','$player_name','$player_pic','$base_price','$category','$bid_amount','$retain')");
        header("location:admin_auction_panel.php");
    }

}


// Fetch New Player

$new_player_query = mysqli_query($db, "select * from selected_auction_player");
$fetch_current_player_data = mysqli_fetch_assoc(mysqli_query($db, "select * from selected_auction_player"));

// Sold Player 
if (isset($_REQUEST['sold'])) {

    $player_name = $fetch_current_player_data['player_name'];
    $player_pic = $fetch_current_player_data['player_pic'];
    $player_cate = $fetch_current_player_data['category'];
    $player_id = $_REQUEST['player_id'];
    $team_id = $_REQUEST['team_id'];
    $price = $_REQUEST['price'];

    $sold_query = mysqli_query($db, "insert into live_auction(player_id,team_id,player_name,player_pic,player_cate,price) values('$player_id','$team_id','$player_name','$player_pic','$player_cate','$price')");

    // Update The Sold Player Team Amount ollr Budget
    $team_now_budget = $_REQUEST['budget'];
    $sold_team_budget = $team_now_budget - $price;
    $updater_team_budget = mysqli_query($db, "update auction_panel set budget= '$sold_team_budget' where team_id = '$team_id' ");

    // Remove Player Table
    $remove_player_query = mysqli_query($db, "delete from live_players where player_id = '$player_id'");

    // Remove From Current Player 
    $remove_current_player_query = mysqli_query($db, "delete from selected_auction_player where player_id = '$player_id'");

    header("location:admin_auction_panel.php");


}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Auction Panel</title>
    <link rel="stylesheet" href="config/panel_media.css">
    <link rel="stylesheet" href="config/panel.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <!-- Auction Logout button -->
    <div class="auction_logout">
        <a href="admin_auction_logout.php"><i class='bx bx-log-out'></i></a>
    </div>

    <!-- Body Content Here -->
    <div class="panel_nav">
        <img src="admin/assets/auction_panel_logo.png" alt="">
    </div>

    <!-- Main Panel -->
    <div class="panel_container">
        <div class="left player_desc">
            <h2>Current Player Details</h2>
            <?php

            if (mysqli_num_rows($new_player_query) > 0) {

                $fetch_player = mysqli_fetch_assoc($new_player_query);

                ?>
                <div class="player_info">
                    <div class="player_banner">
                        <?php

                        if ($fetch_player['player_pic'] == '') {
                            echo "<img src='admin/images/players/default_player_img.png' style='margin-left: 20%; width: 1000%;'>";
                        }

                        ?>
                        <img src="admin/images/players/<?php echo $fetch_player['player_pic'] ?>" alt="">
                    </div>
                    <div class="player_stats">
                        <h3><?php echo $fetch_player['player_name']; ?></h3>
                        <h3><span>Specialization :-
                            </span><?php if ($fetch_player['category'] == 'Bat') {
                                echo "🏏";
                            } else if ($fetch_player['category'] == 'Bow') {
                                echo "<i class='bx bxs-cricket-ball'></i>";
                            } else if ($fetch_player['category'] == 'AR') {
                                echo "<img src='admin/assets/ar.svg' style='width: 50px;'>";
                            } else {
                                echo "<img src='admin/assets/teams-wicket-keeper-icon.svg' style='width: 50px;'>";
                            } ?>
                        </h3>
                        <h3><span>Base Price :- </span>
                            <?php if ($fetch_player['base_price'] == '20L') {
                                echo "20 Lakhs";
                            } else {
                                echo $fetch_player['base_price'] . " Cr ";
                            } ?>
                        </h3>
                        <h3><span>RTM :- </span>
                            <?php
                            $rtm_team_id = $fetch_player['retain_team'];
                            $rtm_team_fetch = mysqli_fetch_assoc(mysqli_query($db, "select * from teams where team_id = '$rtm_team_id'")) ?>
                            <img src="admin/images/teams/<?php echo $rtm_team_fetch['team_logo'] ?>" alt="">
                        </h3>
                    </div>
                </div>

            <?php } else { ?>
                <div class="player_info">
                    <h2>Auction Is not start from admin pleasse wait...😊</h2>
                </div>
            <?php } ?>
        </div>
        <div class="right bid_desc">
            <h2>Current Bid Details</h2>


            <div class="bid_info">
                <div class="bid_banner">
                    <img src="admin/images/teams/" alt="">
                </div>
                <div class="bid_stats">
                    <h3 class="current_amount">Current Bid :- </h3>
                </div>

            </div>


            <div class="current_team_login_action_panel manage_auction_panel_admin">


                <div class="current_team_info_auction manage_auction_panel">

                    <div class="manage_auction_actions_buttons">
                        <form action="#" method="post" class="new_player">
                            <button name="new_player">New Player</button>
                        </form>
                        <form action="#" method="post" class="sold_player">
                            <input type="hidden" name="player_id"
                                value="<?php echo $fetch_current_player_data['player_id'] ?>">
                            <input type="hidden" id="team_id" name="team_id" value="">
                            <input type="hidden" id="player_sold_amount" name="price" readonly>
                            <input type="hidden" id="current_team_bid_budget" name="budget" readonly>
                            <button name="sold">Sold</button>
                        </form>
                        <button>UnSold</button>
                        <button><a
                                href="retain_player_card.php?retain=<?php echo $fetch_current_player_data['sap_id'] ?>">Retain
                                Player</a></button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Javascript file content here -->

    

    <!-- Fetch The Bid Amount -->
    <script>
        // Function to fetch live bid details
        // Function to fetch live bid details
        function fetchBidDetails() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "fetch_bid.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (this.status === 200) {
                    let response = JSON.parse(this.responseText);
                    if (response.status === "success") {
                        document.querySelector(".current_amount").innerHTML = `Current Bid :- ${response.data.bid_amount} Cr`;
                        document.querySelector(".bid_banner img").src = response.data.team_logo;
                        document.getElementById("team_id").value = response.data.team_id;
                        document.getElementById("current_team_bid_budget").value = response.data.bid_team_budget;
                        document.getElementById("player_sold_amount").value = response.data.bid_amount; // ✅ input box में bid_amount सेट करना
                    }
                }
            };

            xhr.send();
        }

        // Function to place a bid
        function placeBid() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "update_bid.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (this.status === 200) {
                    let response = JSON.parse(this.responseText);
                    if (response.status === "success") {
                        fetchBidDetails(); // Refresh the bid details after updating
                    } else {
                        alert(response.message);
                    }
                }
            };

            xhr.send();
        }

        // Auto-refresh bid every 3 seconds
        setInterval(fetchBidDetails, 50);

        // Click event for bid button
        document.querySelector(".bid_stats button").addEventListener("click", placeBid);

    </script>

</body>

</html>