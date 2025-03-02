<!-- Session Check -->
<?php

session_start();

include("admin/db.php");

if (!$_SESSION['logins']) {
    header("location:users/login.php");
}

// Current User 
$user = $_SESSION['logins'];
$user_data = mysqli_fetch_assoc(mysqli_query($db, "select * from teams where team_email = '$user'"));


// Fetch Current Team Details
$team_id = $user_data['team_id'];
$team_squad_batters = mysqli_query($db, "select * from live_auction where team_id = '$team_id' and (player_cate = 'Bat' or player_cate = 'WK')");
$team_squad_ars = mysqli_query($db, "select * from live_auction where team_id = '$team_id' and player_cate = 'AR'");
$team_squad_bowlers = mysqli_query($db, "select * from live_auction where team_id = '$team_id' and player_cate = 'Bow'");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $user_data['team_name'] ?> Squad </title>
    <link rel="stylesheet" href="config/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<style>
    /* This Page Stylling Here */


    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        text-decoration: none;
        font-family: 'Jost', sans-serif;
        scroll-behavior: smooth;
    }

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

    .team_squad_container {
        width: 100%;
        padding: 1rem;
        height: auto;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        align-items: start;
        justify-content: center;
    }

    .team_squad_container h4 {
        font-size: 1.5rem;
        color: var(--black-colro);
        font-weight: 600;
        margin: 0 5rem;
    }

    .team_squad_container .error_need {
        font-size: 1rem;
        color: var(--epcl-text-color);
    }



    .squad_grid {
        width: 100%;
        display: grid;
        grid-template-columns: auto auto auto auto auto auto;
        grid-template-rows: auto auto auto auto auto auto;
        gap: 1rem;
        padding: 1rem 5rem;
    }

    .squad_iteam_box {
        width: 200px;
        background: #fff;
        display: flex;
        align-items: start;
        justify-content: center;
        flex-direction: column;
        height: auto;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
        overflow: hidden;
        position: relative;
        z-index: -2;
    }

    .item_img {
        width: 100%;
        height: 150px;
        padding: 0 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        /* position: relative; */
        overflow: hidden;
    }

    .item_img img {
        position: absolute;
        width: 150px;
        top: 5%;
        z-index: -1;

    }


    .item_stats {
        width: 100%;
        padding: 1.5rem 0;
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
        border-top-left-radius: 100%;
        border-top-right-radius: 100%;
        background: #03175d;
        /* margin: 1rem 0; */
    }

    .item_stats h3 {
        color: #fff;
        font-size: 1rem;
        font-weight: 600;
    }

    .item_stats span {
        color: var(--body-color);
        font-size: 0.8rem;
    }

    .back_btn {
        position: absolute;
        top: 0%;
        left: 0%;
        padding: 1rem;
    }

    .back_btn a {
        font-size: 2rem;
        color: var(--black-colro);
        cursor: pointer;
    }
</style>

<body>

    <div class="back_btn">
        <a href="auction_panel.php"><i class='bx bx-arrow-back'></i></a>
    </div>

    <!-- Current Team Squad -->
    <div class="team_squad_container">

        <h4>Batter's</h4>
        <div class="squad_grid bat">
            <?php

            if (mysqli_num_rows($team_squad_batters) > 0) {

                while ($row = mysqli_fetch_assoc($team_squad_batters)) {

                    ?>


                    <div class="squad_iteam_box">
                        <div class="item_img">
                            <img src="admin/images/players/<?php if ($row['player_pic'] == '') {
                                echo "default_player_img.png";
                            } else {
                                echo $row['player_pic'];
                            } ?>" alt="">
                        </div>
                        <div class="item_stats">
                            <h3><?php echo $row['player_name'] ?></h3>
                            <span><?php if($row['player_cate'] == 'WK') { echo "Wicket-Keeper";} else { echo "Batter";}?></span>
                        </div>
                    </div>


                <?php }
            } else { ?>

                <h4 class="error_need">You Don't Have All Batter's</h4>

            <?php } ?>

        </div>


        <h4>All Rounders's</h4>
        <div class="squad_grid bat">
            <?php

            if (mysqli_num_rows($team_squad_ars) > 0) {

                while ($row = mysqli_fetch_assoc($team_squad_ars)) {

                    ?>


                    <div class="squad_iteam_box">
                        <div class="item_img">
                            <img src="admin/images/players/<?php if ($row['player_pic'] == '') {
                                echo "default_player_img.png";
                            } else {
                                echo $row['player_pic'];
                            } ?>" alt="">
                        </div>
                        <div class="item_stats">
                            <h3><?php echo $row['player_name'] ?></h3>
                            <span>All-Rounder</span>
                        </div>
                    </div>


                <?php }
            } else { ?>

                <h4 class="error_need">You Don't Have All Rounder's</h4>


            <?php } ?>
        </div>


        <h4>Bowler's</h4>
        <div class="squad_grid bat">

            <?php

            if (mysqli_num_rows($team_squad_bowlers) > 0) {

                while ($row = mysqli_fetch_assoc($team_squad_bowlers)) {

                    ?>

                    <div class="squad_iteam_box">
                        <div class="item_img">
                            <img src="admin/images/players/<?php if ($row['player_pic'] == '') {
                                echo "default_player_img.png";
                            } else {
                                echo $row['player_pic'];
                            } ?>" alt="">
                        </div>
                        <div class="item_stats">
                            <h3><?php echo $row['player_name'] ?></h3>
                            <span>Bowlers</span>
                        </div>
                    </div>


                <?php }
            } else { ?>


                <h4 class="error_need">You Don't Have Bowler's</h4>

            <?php } ?>

        </div>




    </div>


    <!-- Javascript Content Here -->

</body>

</html>