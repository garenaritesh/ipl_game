<?php

include("admin/db.php");

// Fetch Retain data

if (isset($_REQUEST['retain'])) {
    $sap_id = $_REQUEST['retain'];
    $sql = "select * from selected_auction_player where sap_id = '$sap_id'";
    $res_retain = mysqli_query($db, $sql);
    $retain_data = mysqli_fetch_assoc($res_retain);
    $retain_team_id = $retain_data['retain_team'];
    $bid_team_id = $retain_data['bid_team_id'];
    $fetch_bid_team_budget = mysqli_fetch_assoc(mysqli_query($db,"select * from auction_panel where team_id = '$bid_team_id'"));
    $fetch_retain_team_budget = mysqli_fetch_assoc(mysqli_query($db, "select * from auction_panel where team_id = '$retain_team_id'"));
}


// Retain Yes To Update Data
if (isset($_REQUEST['retain_yes'])) {

    $bid_amount = $_REQUEST['bid_amount'];
    $player_current_bid_amount = $retain_data['bid_amount'];

    if ($bid_amount == $player_current_bid_amount) {

        $player_name = $retain_data['player_name'];
        $player_pic = $retain_data['player_pic'];
        $player_cate = $retain_data['category'];
        $player_id = $retain_data['player_id'];
        $team_id = $retain_data['retain_team'];
        $status = "R";

        $sold_query = mysqli_query($db, "insert into live_auction(player_id,team_id,player_name,player_pic,player_cate,price,status) values('$player_id','$team_id','$player_name','$player_pic','$player_cate','$bid_amount','$status')");

        // Update The Sold Player Team Amount ollr Budget
        $team_now_budget = $_REQUEST['budget'];
        $sold_team_budget = $team_now_budget - $bid_amount;
        $updater_team_budget = mysqli_query($db, "update auction_panel set budget = '$sold_team_budget' where team_id = '$team_id' ");

        // Remove Player Table
        $remove_player_query = mysqli_query($db, "delete from live_players where player_id = '$player_id'");

        // Remove From Current Player 
        $remove_current_player_query = mysqli_query($db, "delete from selected_auction_player where player_id = '$player_id'");

        header("location:admin_auction_panel.php");
    } else {
        echo "Your bid is lower than the current bid";
    }

}


// Retain Yes To Update Data
if (isset($_REQUEST['retain_no'])) {

    $bid_amount = $_REQUEST['bid_amount'];
    $player_current_bid_amount = $retain_data['bid_amount'];

    if ($bid_amount == $player_current_bid_amount) {

        $player_name = $retain_data['player_name'];
        $player_pic = $retain_data['player_pic'];
        $player_cate = $retain_data['category'];
        $player_id = $retain_data['player_id'];
        $team_id = $retain_data['bid_team_id'];

        $sold_query = mysqli_query($db, "insert into live_auction(player_id,team_id,player_name,player_pic,player_cate,price) values('$player_id','$team_id','$player_name','$player_pic','$player_cate','$bid_amount')");

        // Update The Sold Player Team Amount ollr Budget
        $bid_team_now_budget = $fetch_bid_team_budget['budget'];
        $sold_team_budget = $bid_team_now_budget - $bid_amount;
        $updater_team_budget = mysqli_query($db, "update auction_panel set budget = '$sold_team_budget' where team_id = '$team_id' ");

        // Remove Player Table
        $remove_player_query = mysqli_query($db, "delete from live_players where player_id = '$player_id'");

        // Remove From Current Player 
        $remove_current_player_query = mysqli_query($db, "delete from selected_auction_player where player_id = '$player_id'");

        header("location:admin_auction_panel.php");
    } else {
        echo "Your bid is lower than the current bid";
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Retain Player Card </title>
    <link rel="stylesheet" href="config/panel.css">
</head>

<style>
    :root {
        --body-color: #F9F9FE;
        --epcl-main-color: #2563eb;
        --epcl-secondary-color: #65EBE7;
        --epcl-titles-color: #454360;
        --epcl-black-color: #4B4870;
        --epcl-text-color: #596172;
        --black-colro: #1f2937;
        --white-color: #fff;
        --p-text-color: #535b67;
        --epcl-border-color: #EEEEEE;
        --epcl-input-bg-color: #F9F9FE;
        --box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        --header-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
    }

    .container {
        width: 100%;
        padding: 1rem;
        background: #fff;
        height: auto;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .current_retain_player_info {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }

    .current_retain_player_info .retain_player_info {
        width: 100%;
        padding: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 1rem 0;
    }

    .current_retain_player_info .retain_player_info .player_info_dtl {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        width: 30%;
        align-items: center;
        justify-content: center;
    }

    .current_retain_player_info .retain_player_info .player_info_dtl img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
    }

    .current_retain_player_info .retain_player_info p {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }

    .current_retain_player_info .retain_player_info p span {
        font-size: 2rem;
        font-weight: 600;
    }


    .retain_team_desc {
        width: 100%;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .retain_team_desc .team_retain_info {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 3rem 1rem;
    }

    .retain_team_desc .team_retain_info input {

        padding: 0.7rem 1rem;
        width: 200px;
        font-size: 2rem;
        text-align: center;
        outline: none;
        border: 1px solid var(--epcl-border-color);

    }


    .retain_team_desc button {
        width: 20%;
        background: #000;
        color: var(--body-color);
        outline: none;
        border: none;
        padding: 0.7rem 2rem;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        font-weight: 600;
        cursor: pointer;
        margin-left: 40%;
    }

    .retain_team_desc button img {
        width: 30px;
    }

    .current_team_bid_div {
        display: flex;
        width: 30%;
        flex-direction: column;
        gap: 1rem;
        align-items: center;
        justify-content: center;
    }

    .current_team_bid_div img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
    }

    @media(max-width:420px) {
        .current_retain_player_info .retain_player_info .player_info_dtl {
            width: 15%;
        }

        .current_retain_player_info .retain_player_info .player_info_dtl img {
            width: 50px;
            height: 50px;
        }

        .current_retain_player_info .retain_player_info p {
            display: flex;
            flex-direction: column-reverse;
        }

        .current_retain_player_info .retain_player_info p span {
            font-size: 1rem;
        }

        .retain_team_desc .team_retain_info input {
            font-size: 1rem;
            width: 100px;
        }

        .retain_team_desc .team_retain_info input::placeholder {
            font-size: 0.7rem;
        }

        .current_team_bid_div img {
            width: 100px;
            height: 100px;
        }

        .current_team_bid_div {
            width: 20%;
        }

        .current_team_bid_div p {
            font-size: 0.6rem;
        }

        .retain_team_desc button {
            width: 70%;
            margin-left: 15%;
            gap: 3rem;
        }
    }
</style>

<body>

    <!-- Body Content Here -->
    <div class="container">
        <div class="current_retain_player_info">
            <h3>Retain Player Detail</h3>
            <div class="retain_player_info">
                <div class="player_info_dtl">
                    <img src="admin/images/players/<?= !empty($retain_data['player_pic']) ? $retain_data['player_pic'] : 'default_player_img.png'; ?>"
                        alt="">
                    <p><?php echo $retain_data['player_name'] ?></p>
                </div>
                <p>current bid amount :- <span> <?php echo $retain_data['bid_amount'] ?> Cr </span></p>
            </div>
        </div>


        <form action="#" method="post" class="retain_team_desc">
            <div class="team_retain_info">
                <div class="current_team_bid_div">
                    <?php
                    $current_team_bid_id = $retain_data['bid_team_id'];
                    $fetch_current_team_bid_logo = mysqli_fetch_assoc(mysqli_query($db, "select * from teams where team_id = '$current_team_bid_id'")) ?>
                    <img src="admin/images/teams/<?php echo $fetch_current_team_bid_logo['team_logo']; ?>" alt="">
                    <p>Current Team Bid</p>
                </div>
                <input type="text" name="bid_amount" placeholder="Retain Price" required>
                <input type="hidden" name="budget" value="<?php echo $fetch_retain_team_budget['budget'] ?>">
                <!-- Bid Team Budget -->
                 <input type="text" name="bid_team_budget" value="<?php echo $fetch_bid_team_budget['budget']?>" readonly>
                <div class="current_team_bid_div">
                    <?php
                    $retain_team_bid_id = $retain_data['retain_team'];
                    $fetch_retain_team_bid_logo = mysqli_fetch_assoc(mysqli_query($db, "select * from teams where team_id = '$retain_team_bid_id'")) ?>
                    <img src="admin/images/teams/<?php echo $fetch_retain_team_bid_logo['team_logo']; ?>" alt="">
                    <p>Retain Team Card</p>
                </div>
            </div>
            <button name="retain_yes"><img
                    src="admin/images/teams/<?php echo $fetch_current_team_bid_logo['team_logo'] ?>" alt=""> To <img
                    src="admin/images/teams/<?php echo $fetch_retain_team_bid_logo['team_logo'] ?>" alt=""></button>
            <button name="retain_no">
                <img src="admin/images/teams/<?php echo $fetch_retain_team_bid_logo['team_logo'] ?>" alt=""> To<img
                    src="admin/images/teams/<?php echo $fetch_current_team_bid_logo['team_logo'] ?>" alt="">
            </button>
        </form>

    </div>

</body>

</html>