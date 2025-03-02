<?php

include("panel.php");

// Fetch The All Teams 

$team_query = mysqli_query($db, "select * from teams");

// Insert The Data In New Auction
// Check if form is submitted
if (isset($_POST['submit'])) {
    if (!empty($_POST['teams'])) {
        foreach ($_POST['teams'] as $player) {
            $player = mysqli_real_escape_string($db, $player);
            $fetch_email = mysqli_fetch_assoc(mysqli_query($db, "select * from teams where team_id = '$player'"));
            $team_email = $fetch_email['team_email'];
            $sql = "INSERT INTO auction_panel(team_id,team_email) VALUES ('$player','$team_email')";
            mysqli_query($db, $sql);
        }

        // Remove Old Sold and Unsold Players
        $remove_old_sold_players = mysqli_query($db,"truncate table live_auction");

        // Remove old players
        $remove_old_live_players = mysqli_query($db,"truncate table live_players");

        // Insert all the data of player table into live_auction table
        $live_auction_players_query = mysqli_query($db,"insert into live_players(player_id,player_name,player_pic,base_price,category,retain_team) select * from players");
        
        echo "Players successfully added to the team!";
        header("location:manage_auction.php");
    } else {
        echo "No player selected!";
    }
}


// Check The Auction Has Already Start Or Not

$checkSql = "select * from auction_panel where status = 'On'";
$checkAuction = mysqli_query($db, $checkSql);
$checkAuctionRow = mysqli_num_rows($checkAuction);

// Fetch Auction Id
$table_name_auction_panel = "auction_panel";
// $fetchAuctionIdQuery = mysqli_query($db, "TRUNCATE TABLE auction_panel");
if(isset($_REQUEST['restart_auction'])){
    $table_name = $_REQUEST['restart_auction'];
    $change_the_table = "selected_auction_player";
    $sql = "TRUNCATE TABLE $table_name";
    mysqli_query($db,"truncate table $change_the_table");
    mysqli_query($db, $sql);
    header("location:manage_auction.php");
}


?>
<style>
    :root {

        /* Another Styllling */
        --text-color: #414141;
        --white-color: #ffffff;
        --hover-text-color: #6b7284;

        /* Fix The Colours */
        --body-color: #F9F9FE;
        --epcl-main-color: #FF4C60;
        --epcl-secondary-color: #65EBE7;
        --epcl-titles-color: #454360;
        --epcl-black-color: #4B4870;
        --epcl-text-color: #596172;
        --epcl-border-color: #EEEEEE;
        --epcl-input-bg-color: #F9F9FE;
        --box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        --header-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
    }

    .player_form {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .player_form .auction_btn {
        width: 200px;
        margin: 2rem 0;
    }

    .player_form input {
        width: 300px;
        padding: 0.6rem 1rem;
        border: 1px solid var(--epcl-border-color);
        outline: none;
        font-weight: 400;
    }

    .restart_auction_btn {
        background: #000;
        color: #fff;
        cursor: pointer;
        text-align: center;
        padding: 0.8rem 1rem;
        border: none;
        outline: none;
        font-size: 1rem;
        width: 200px;
    }


    .player_form .document label img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        cursor: pointer;
        object-fit: cover;
        box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
    }

    .player_form .document label p {
        font-size: 0.8rem;
    }

    .player_form .categories {
        display: flex;
        width: 50%;
    }

    .player_form .categories .cate {
        display: flex;
        width: 180px;
        align-items: center;
        justify-content: space-around;
        padding: 1rem 2rem;
    }

    .player_form .team_list {
        width: 100%;
        display: grid;
        grid-template-columns: auto auto auto auto;
        grid-template-rows: auto auto auto auto;
    }

    .player_form .categories .teams_cate {
        width: 200px;
    }

    .player_form .categories .cate span {
        display: flex;
        align-items: center;
    }

    .player_form .categories .cate span img {
        width: 40px;
    }

    .player_form button {
        background: #000;
        color: #fff;
        cursor: pointer;
        padding: 0.8rem 1rem;
        border: none;
        outline: none;
        font-size: 1rem;
        width: 100px;
    }
</style>


<h4> New Auction </h4>

<?php

if ($checkAuctionRow > 0) {
    echo "Auction Already Start";

    ?>

    <a href="manage_auction.php?restart_auction=<?php echo $table_name_auction_panel;?>" class="restart_auction_btn">Restart Auction</a>

    <?php

} else {


    ?>


    <form action="#" class="player_form" method="post" enctype="multipart/form-data" autocomplete="off">
        <p>Select Team for the new auction</p>
        <div class="categories team_list">
            <?php
            while ($teams = mysqli_fetch_assoc($team_query)) {
                ?>
                <div class="cate teams_cate">
                    <span><img src="../images/teams/<?php echo $teams['team_logo'] ?>" alt=""></span>
                    <input type="checkbox" name="teams[]" value="<?php echo $teams['team_id'] ?>">
                </div>
                <?php
            } ?>
        </div>

        <button class="auction_btn" name="submit">Start Auction</button>

    </form>

<?php } ?>