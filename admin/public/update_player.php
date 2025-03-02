<?php

include("panel.php");


// Player Id To Update Him
if (isset($_REQUEST['edt_player'])) {
    $player_id = $_REQUEST['edt_player'];
    $sql = "select * from players where player_id = '$player_id'";
    $result = mysqli_query($db, $sql);
    $player = mysqli_fetch_assoc($result);
}

// Update Data Of Player

if (isset($_REQUEST['update_player_data'])) {
    $player_id = $_REQUEST['player_id'];

    $player_pic = $_FILES['player_pic']['name'];
    move_uploaded_file($_FILES['player_pic']['tmp_name'], '../images/players/' . $player_pic);

    $sql = "update players set player_pic='$player_pic' where player_id = '$player_id'";
    $res = mysqli_query($db,$sql);
    header("location:players.php");


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

    /* Style */

    .form_data {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 2rem;
        align-items: start;
        justify-content: start;
    }

    .form_data .player_pic {
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }

    .form_data .player_pic img {
        width: 100%;
        object-fit: cover;
    }

    form button {
        padding: 0.7rem 2rem;
        border: none;
        cursor: pointer;
        outline: none;
        color: var(--body-color);
        border-radius: 3px;
        background: #2563eb;
        margin: 1rem 0;
    }
</style>

<h4>Update Player Details</h4>

<form action="#" method="post" enctype="multipart/form-data">
    <div class="form_data">
        <div class="player_pic">
            <?php

            if ($player['player_pic'] == '') {

                echo "<img src='../images/players/default_player_img.png'>";

            } else {

                ?>
                <img src="../images/players/<?php echo $player['player_pic'] ?>" alt="">
                <?php
            }

            ?>
        </div>
        <label for="#">Add New Player Pic</label>
        <input type="hidden" name="player_id" value="<?php echo $player['player_id'] ?>">
        <input type="file" name="player_pic" required>
    </div>
    <button name="update_player_data">Update Data</button>
</form>