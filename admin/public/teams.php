<?php

include("panel.php");

// Fetch The All Teams 

$team_query = mysqli_query($db, "select * from teams");

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
        --header-shadow-: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
    }

    .teams_grid {
        width: 100%;
        display: grid;
        grid-template-columns: auto auto auto;
        grid-template-rows: auto auto auto;
        gap: 2rem;
    }

    .team_box {
        width: 300px;
        display: flex;
        flex-direction: column;
        gap: 0;
        align-items: center;
        justify-content: center;
        background: #fff;
        box-shadow: var(--box-shadow);
        border-radius: 1rem;
        position: relative;
        overflow: hidden;
    }

    .team_box .team_logo {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        border-bottom-right-radius: 50%;
        border-bottom-left-radius: 50%;
    }

    .team_box .team_logo img {
        width: 120px;
    }

    .team_box .team_name_box {
        width: 100%;
        padding: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 150px;
        background: #03175d;
        color: #fff;
        border-top-right-radius: 100%;
        border-top-left-radius: 100%;
    }

    .team_box .team_name_box h2 {
        font-size: 1rem;
        font-weight: 400;
    }
</style>

<h4>Teams</h4>


<div class="teams_grid">
    <?php
    while ($teams = mysqli_fetch_assoc($team_query)) {
        ?>
        <div class="team_box">
            <div class="team_logo">
                <img src="../images/teams/<?php echo $teams['team_logo']; ?>" alt="">
            </div>
            <div class="team_name_box">
                <h2><?php echo $teams['team_name']; ?></h2>
            </div>
        </div>
    <?php } ?>
</div>