<?php

include("panel.php");


// insert player Data in database

if (isset($_REQUEST['add_player'])) {

    $player_name = $_REQUEST['player_name'];
    $base_price = $_REQUEST['base_price'];
    $category = $_REQUEST['category'];
    $retain = $_REQUEST['retain_team'];

    $player_pic = $_FILES['player_pic']['name'];
    move_uploaded_file($_FILES['player_pic']['tmp_name'], '../images/players/' . $player_pic);

    $sql = "insert into players(player_name,player_pic,base_price,category,retain_team) values('$player_name','$player_pic','$base_price','$category','$retain')";
    mysqli_query($db, $sql);
    header("location:add_player.php");
}

// Fetch Teams For Retain Cards
$fetch_team_retains = mysqli_query($db, "select * from teams");

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

    .player_form input {
        width: 300px;
        padding: 0.6rem 1rem;
        border: 1px solid var(--epcl-border-color);
        outline: none;
        font-weight: 400;
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

    .player_form .categories .cate span {
        display: flex;
        align-items: center;
    }

    .player_form .categories .cate span img {
        width: 30px;
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

    .player_form .team_retain_cate_section {
        width: 100%;
        display: grid;
        grid-template-columns: auto auto auto auto auto auto;
        grid-template-rows: auto auto auto auto auto auto;
    }

</style>

<h4>Add Player</h4>

<form action="#" class="player_form" method="post" enctype="multipart/form-data" autocomplete="off">
    <p>Player Information</p>
    <div class="document">
        <label for="profilePic">
            <img src="../assets/upload_icon.png" alt="Profile Picture" id="profilePreview">
            <p>Profile Picture</p>
        </label>
        <input type="file" hidden id="profilePic" name="player_pic" accept="image/*">
    </div>
    <input type="text" name="player_name" placeholder="Player Name">
    <p>Base Price</p>
    <div class="categories base">
        <div class="cate">
            <span>20L</span>
            <input type="checkbox" name="base_price" value="20L">
        </div>
        <div class="cate">
            <span>1Cr</span>
            <input type="checkbox" name="base_price" value="1">
        </div>
        <div class="cate">
            <span>2Cr</span>
            <input type="checkbox" name="base_price" value="2">
        </div>
    </div>
    <p> Player Category</p>
    <div class="categories">
        <div class="cate">
            <span>🏏</span>
            <input type="checkbox" name="category" value="Bat">
        </div>
        <div class="cate">
            <span><i class='bx bxs-cricket-ball'></i></span>
            <input type="checkbox" name="category" value="Bow">
        </div>
        <div class="cate">
            <span>🏏<i class='bx bxs-cricket-ball'></i></span>
            <input type="checkbox" name="category" value="AR">
        </div>
        <div class="cate">
            <span><img src="https://www.iplt20.com/assets/images/teams-wicket-keeper-icon.svg" alt=""></span>
            <input type="checkbox" name="category" value="WK">
        </div>
    </div>

    <p> Retain Team Card </p>
    <div class="categories team_retain_cate_section">
        <?php

        while ($team_data = mysqli_fetch_assoc($fetch_team_retains)) {

            ?>
            <div class="cate">
                <span> <img src="../images/teams/<?php echo $team_data['team_logo'] ?>" alt=""> </span>
                <input type="checkbox"  name="retain_team" value="<?php echo $team_data['team_id'] ?>">
            </div>

        <?php } ?>

    </div>

    <!-- Data Submit Button Here -->

    <button name="add_player">Add</button>

</form>


<script>
    const previewFile = (input, previewId) => {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                document.getElementById(previewId).src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    };

    document.getElementById('profilePic').addEventListener('change', function () {
        previewFile(this, 'profilePreview');
    });
</script>