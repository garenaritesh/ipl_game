<?php

include("panel.php");

// Get Expensive Player 
$expensive_player_res = mysqli_query($db, "SELECT * FROM live_auction ORDER BY price DESC LIMIT 1");


// Get Auction Data
$sold_players = mysqli_num_rows(mysqli_query($db, "select * from live_auction"));
$unsold_players = mysqli_num_rows(mysqli_query($db, "select * from live_players"));
$rtms = mysqli_num_rows(mysqli_query($db, "select * from live_auction where status = 'R'"));
$spent_money = mysqli_query($db, 'select sum(price) as total_spent from live_auction');

// Fetch All Team They Have In Current Auction
$teams = mysqli_query($db, "select * from auction_panel");


?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200..1000&display=swap');

    /* font-family: "Oswald", sans-serif; */

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

    .auction_data {
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
        align-items: start;
        justify-content: start;
        gap: 1rem;
        background: url("../assets/bg_img.png");
    }

    .auction_data h2 {
        font-size: 1rem;
        color: var(--black-colro);
        width: 40%;
        text-align: center;
    }

    .most_expensive_player {
        width: 100%;
        display: flex;
        align-items: start;
        justify-content: center;
        gap: 1rem;
        padding: 0 0 1rem 0;
        border-bottom: 0.3rem solid #ff7a00;
    }


    .most_expensive_player_dtl {
        width: 40%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 0.5rem;
    }



    .most_expensive_player_dtl .player_team_logo {
        width: 100px;
        height: 100px;
        position: relative;
    }

    .most_expensive_player_dtl .player_team_logo img {
        width: 100%;
    }

    .most_expensive_player_dtl h3 {
        font-size: 1rem;
        font-family: "Oswald", sans-serif;
        color: var(--black-colro);
    }

    .most_expensive_player_dtl h1 {
        font-size: 1.8rem;
        font-family: "Oswald", sans-serif;
    }

    .auction_dtls {
        width: 60%;
        height: auto;
        padding: 1rem;
        background-color: rgba(14, 19, 35, 0.78);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 2rem;
    }

    .auction_dtls .data_auction_dtl {
        padding: 3rem 2rem;
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
        align-items: center;
        justify-content: center;
    }

    .auction_dtls .data_auction_dtl h3 {
        font-size: 1.5rem;
        font-family: "Oswald", sans-serif;
        color: #fff;
        font-weight: 800;
    }


    .auction_dtls .data_auction_dtl p {
        color: var(--body-color);
        font-size: 1rem;
        font-weight: 400;
        font-family: "Oswald", sans-serif;
    }

    /* Team Data Show */

    .team_data {
        width: 100%;
        display: grid;
        grid-template-columns: auto auto auto auto;
        grid-template-rows: auto auto auto auto;
        gap: 1.5rem;
        background: #fff;
        justify-content: center;
        align-items: center;
    }

    .team_block {
        width: 280px;
        padding: 1rem 0 0.3rem 0.3rem;
        background: #fff;
        box-shadow: var(--box-shadow);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        height: auto;
        align-items: center;
        border-radius: 1rem;
        cursor: pointer;
        justify-content: center;
    }

    .team_block img {
        width: 100px;
    }

    .team_block .team_block_data {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .team_block .team_block_data .team_used_data {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        border-top: 1px solid var(--epcl-border-color);
        margin: 0 1rem 0 0;
        padding: 0.5rem;
    }

    .team_block .team_block_data h3 {
        font-family: "Oswald", sans-serif;
    }

    .team_block .team_block_data .team_used_data .team_used_data_block {
        width: 50%;
        display: flex;
        flex-direction: column;
        padding: 0.2rem;
        align-items: center;
        justify-content: center;

    }

    .team_block .team_block_data .team_used_data .team_used_data_block:nth-child(1) {
        border-right: 1px solid var(--epcl-border-color);
    }
</style>

<div class="auction_data">
    <h2>Most Expensive Player</h2>
    <div class="most_expensive_player">
        <?php

        if (mysqli_num_rows($expensive_player_res) > 0) {
            $expensive_player = mysqli_fetch_assoc($expensive_player_res);
            ?>
            <div class="most_expensive_player_dtl">
                <div class="player_team_logo">
                    <?php

                    $get_teamid = $expensive_player['team_id'];
                    $sql = "select * from teams where team_id = '$get_teamid' ";
                    $team_logo = mysqli_fetch_assoc(mysqli_query($db, $sql));

                    ?>
                    <img src="../images/teams/<?php echo $team_logo['team_logo']; ?>" alt="">
                </div>
                <div class="player_team_data">
                    <h3><?php echo $expensive_player['player_name'] ?></h3>
                    <h1>₹ <?php echo $expensive_player['price'] ?> Cr</h1>
                </div>
            </div>
        <?php } else { ?>
            <div class="most_expensive_player_dtl">
                <h1>No Record Found</h1>
            </div>
        <?php } ?>
        <div class="auction_dtls">
            <div class="data_auction_dtl">
                <h3><?php echo $sold_players; ?></h3>
                <p>Players Sold</p>
            </div>
            <div class="data_auction_dtl">
                <h3><?php echo $unsold_players; ?></h3>
                <p>Players Unsold</p>
            </div>
            <div class="data_auction_dtl">
                <h3><?php echo $rtms; ?></h3>
                <p>RTM's Used</p>
            </div>
            <div class="data_auction_dtl">
                <h3><?php if ($row = mysqli_fetch_assoc($spent_money)) {
                    echo " ₹ " . number_format($row['total_spent'], 2) . " Cr ";
                } else {
                    echo "0";
                }
                ?></h3>
                <p>Total Spent</p>
            </div>
        </div>
    </div>

    <div class="team_data">
        <?php
        while ($row = mysqli_fetch_assoc($teams)) {

            // Get Team Logo
            $get_teamid = $row['team_id'];
            $sql = "select * from teams where team_id = '$get_teamid' ";
            $team_data = mysqli_fetch_assoc(mysqli_query($db, $sql));

            // Check RTM's
            $rtms = mysqli_num_rows(mysqli_query($db, "select * from live_auction where team_id = '$get_teamid' and status = 'R'"));

            // Count Total Players Of Team 
            $squad = mysqli_num_rows(mysqli_query($db, "select * from live_auction where team_id = '$get_teamid'"));

            ?>
            <div class="team_block">
                <img src="../images/teams/<?php echo $team_data['team_logo'] ?>" alt="">
                <div class="team_block_data">
                    <p>Funds Remaining</p>
                    <h3>₹ <?php echo $row['budget'] ?> Cr</h3>
                    <div class="team_used_data">
                        <div class="team_used_data_block">
                            <p>RTM's</p>
                            <h3><?php if ($rtms == 0) {
                                echo "3";
                            } else if ($rtms == 1) {
                                echo "2";
                            } else if ($rtms == 2) {
                                echo "1";
                            } else {
                                echo "0";
                            } ?>
                            </h3>
                        </div>
                        <div class="team_used_data_block">
                            <p>Total Players</p>
                            <h3><?php echo $squad; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</div>