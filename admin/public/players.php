<?php

include("panel.php");



// fetch Tha all players 



// Find or Search Player Query Here 
if (isset($_REQUEST['search_player'])) {

    $search_player = $_REQUEST['player_name'];

    // If the search query is empty, fetch all courses
    if ($search_player == '') {
        $sql = "SELECT * FROM players";
    } else {
        // Otherwise, fetch courses that match the search query
        $sql = "SELECT * FROM players WHERE player_name LIKE '%$search_player%'";
    }
    $players = mysqli_query($db, $sql);


} else {
    // If the search form was not submitted, show all courses
    $players = mysqli_query($db, "select * from players order by rand()");
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

    /* Desing Table  */

    .player_list {
        width: 100%;
        height: auto;
        border: 1px solid var(--epcl-border-color);
        background: #fff;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        align-items: start;
        justify-content: start;
    }

    .player_item_box {
        width: 100%;
        padding: 0.5rem 3rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        border-bottom: 1px solid var(--epcl-border-color);
    }

    .player_pic img {
        width: 60px;
    }

    .player_dtl {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        align-items: start;
        justify-content: start;
    }

    .player_dtl p {
        font-size: 1rem;
    }

    .player_action {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }

    .player_action a button {
        padding: 0.5rem 1rem;
        border: none;
        background: #2563eb;
        color: #fff;
        font-size: 1rem;
        font-weight: 800;
        cursor: pointer;
    }

    .player_action a:nth-child(2) button {
        background: red;
    }

    .search_box_player {
        width: 500px;
        box-shadow: var(--box-shadow);
        border-radius: 10px;
        background: #fff;
        padding: 0.5rem;
        height: auto;
        position: absolute;
        top: 1%;
        right: 1%;
    }

    .search_box_player form {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.2rem;
    }

    .search_box_player form input {
        width: 80%;
        padding: 0.7rem;
        border: none;
        outline: none;
        cursor: pointer;
    }

    .search_box_player form button {
        font-size: 1rem;
        width: 20%;
        padding: 0.7rem;
        border: none;
        outline: none;
        cursor: pointer;
        background: #000;
        color: #fff;
    }
</style>

<h4>Players</h4>

<div class="player_list">
    <?php while ($row = mysqli_fetch_assoc($players)) { ?>
        <div class="player_item_box">
            <div class="player_pic">
                <img src="../images/players/<?php if ($row['player_pic'] == "") {
                    echo "default_player_img.png";
                } else {
                    echo $row['player_pic'];
                } ?>" alt="Player Pic">
            </div>
            <div class="player_dtl">
                <p><?php echo $row['player_name'] ?></p>
                <p>Retain Team :- <?php echo $row['retain_team'] ?></p>
            </div>
            <div class="player_action">
                <a href="update_player.php?edt_player=<?php echo $row['player_id']?>"><button><i class='bx bx-upload'></i></button></a>
                <a href="#"><button><i class='bx bxs-trash-alt'></i></button></a>
            </div>
        </div>
    <?php } ?>
</div>

<div class="search_box_player">
    <form action="#" method="post">
        <input type="search" name="player_name" placeholder="Player Name">
        <button name="search_player"><i class='bx bx-search-alt'></i></button>
    </form>
</div>