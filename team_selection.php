<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Team Selection </title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="config/panel.css">
</head>


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
        grid-template-columns: auto auto auto auto;
        grid-template-rows: auto auto auto auto;
        gap: 3rem;
        padding: 1rem;
        align-items: center;
        justify-content: center;
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
        position: relative;
    }

    .team_box .hidden_layer_team_box {
        position: absolute;
        width: 100%;
        height: 100%;
        background: #000;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .team_box .hidden_layer_team_box h1 {
        font-size: 5rem;
        transition: all ease 0.2s;
    }

    .team_box .hidden_layer_team_box h1:hover {
        transform: scale(1.1);
        transform: rotate(20deg);
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

<body>

    <!-- Retrive Data From Teams Table -->

    <?php

    include("admin/db.php");

    $teams_query = mysqli_query($db, "select * from teams order by rand() limit 8");


    ?>


    <!-- Fetch Teams Randomly -->


    <div class="teams_grid">
        <?php
        while ($teams = mysqli_fetch_assoc($teams_query)) {
            ?>
            <div class="team_box">
                <!-- Hidden Game Box Banner Pick One -->
                <div class="hidden_layer_team_box">
                    <h1 class="emoji">👋</h1>
                </div>
                <div class="team_logo">
                    <img src="admin/images/teams/<?php echo $teams['team_logo']; ?>" alt="">
                </div>
                <div class="team_name_box">
                    <h2><?php echo $teams['team_name']; ?></h2>
                </div>
            </div>
        <?php } ?>
    </div>


    <!-- Javascript for checking Team -->



    <script>
        document.querySelectorAll(".hidden_layer_team_box h1").forEach(h1 => {
            h1.addEventListener("click", function () {
                this.parentElement.style.display = "none"; // Hide the parent div
            });
        });
    </script>




</body>

</html>