<?php
session_start();
include("admin/db.php");

if (!$_SESSION['team_auction_panel_login']) {
    header("location:index.php");
}



// Current User 
$user = $_SESSION['team_auction_panel_login'];
$user_data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM teams WHERE team_email = '$user'"));
$team_id = $user_data['team_id'];


// Count Total players
@$squad_player_count = mysqli_num_rows(mysqli_query($db, "select * from live_auction where team_id = '$team_id'"));


// Fetch Current Bid Team From Select Auction Player Table
$fetch_current_team_bid = mysqli_fetch_assoc(mysqli_query($db, "select * from selected_auction_player"));
@$fetch_current_team_bid_id = $fetch_current_team_bid['bid_team_id'];


// Fetch Current Team Squad 
$fetch_batsman_Of_current_team = mysqli_query($db, "select * from live_auction where player_cate = 'Bat' and team_id = '$team_id'");
$fetch_bowler_Of_current_team = mysqli_query($db, "select * from live_auction where player_cate = 'Bow' and team_id = '$team_id'");
$fetch_ar_Of_current_team = mysqli_query($db, "select * from live_auction where player_cate = 'AR' and team_id = '$team_id'");


// Count Total Player Of Current Team Squd From Sold Tables 
@$fetch_total_players_query = mysqli_query($db, "select * from live_auction where team_id = '$team_id'");
$totalCurrent_team_player = mysqli_num_rows($fetch_total_players_query);

// Count RTM Card From Live Auction Table 
$current_team_rtm = mysqli_num_rows(mysqli_query($db, "select * from live_auction where status = 'R' and team_id = '$team_id'"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction Panel</title>
    <!-- <link rel="stylesheet" href="config/panel_media.css"> -->
    <link rel="stylesheet" href="config/panel.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<style>
    .:root {
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

    .rtm_card_style {
        position: absolute;
        z-index: 500;
        top: 15%;
        left: 2%;
        width: 200px;
        padding: 1rem;
        display: none;

    }



    .rtm_card_style h3 {
        font-size: 5rem;
    }

    @media(max-width: 420px) {
        .rtm_card_style h3 {
            font-size: 2rem;
        }
    }

    #qualified {
        color: green;


    }


    .congrats_div {
        width: 100%;
        height: 80vh;
        display: none;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }

    .congrats_div button {
        background: var(--epcl-main-color);
        padding: 1rem 3rem;
        margin: 1rem 0;
        border: none;
        outline: none;
        color: var(--body-color);
        font-size: 1rem;
        font-weight: 600;
        border-radius: 0.3rem;
        user-select: none;
    }

    .congrats_text {
        text-align: center;
    }

    .congrats_text h1 {
        font-size: 3rem;
        color: var(--epcl-black-color);
    }

    .congrats {
        font-size: 50px;
        font-weight: bold;
        color: var(--epcl-titles-color);
        opacity: 0;
        transform: scale(0.5);
        animation: fadeInScale 2s ease-in-out forwards;
    }

    @keyframes fadeInScale {
        0% {
            opacity: 0;
            transform: scale(0.5);
        }

        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    .confetti {
        position: absolute;
        width: 8px;
        height: 8px;
        background: yellow;
        opacity: 0.8;
        top: 0;
        animation: fall linear infinite;
    }

    @keyframes fall {
        from {
            transform: translateY(-10vh) rotate(0deg);
            opacity: 1;
        }

        to {
            transform: translateY(100vh) rotate(360deg);
            opacity: 0;
        }
    }



    @media(max-width: 420px) {
        .congrats_text h1 {
            font-size: 1.5rem;
        }

        .congrats {
            font-size: 1.5rem;
        }
    }
</style>

<body>




    <!-- Auction Logout button -->
    <div class="auction_logout">
        <a href="my_team.php" class="view_teams"><i class='bx bx-group' id="view_team_sqaud_v"></i>
            <div class="count_player_tab" id="SquadCount"></div>
        </a>
        <a href="auction_logout.php"><i class='bx bx-log-out'></i></a>
    </div>

    <!-- Body Content Here -->
    <div class="panel_nav">
        <img src="admin/assets/auction_panel_logo.png" alt="">
    </div>

    <!-- Congratulation Animation Here -->
    <div class="congrats_div">
        <div class="congrats_text">
            <div class="congrats" id="congrats">🎉 Congratulations! 🎉</div>
            <h1 id="quali_error">🎉 You Qualify for Playoff Rounds! 🎉</h1>
        </div>
        <button>Go To Make Playing XI</button>
    </div>

    <!-- Main Panel -->
    <?php
    if ($squad_player_count == 15) {
        ?>
        <div class="panel_container">
            <div class="left player_desc">
                <h2 id="response">Current Player Details</h2>

                <div class="player_info" id="player_info">
                    <h2>Loading player details...</h2>
                </div>
            </div>

            <div class="right bid_desc" id="bid_desc_panel">
                <h2>Current Bid Details</h2>
                <div class="bid_info">
                    <div class="bid_banner">
                        <img src="admin/assets/header_img.png" alt="">
                    </div>
                    <div class="bid_stats">
                        <div id="bid_team_bidget"></div>
                        <div id="bid_player_budget"></div>
                        <h3 class="current_amount">Current Bid :-</h3>
                        <input type="hidden" id="team_id" value="<?php echo $user_data['team_id'] ?>">
                        <button class="bid_button" id="bid_button">Bid</button>

                    </div>
                </div>

                <div class="current_team_login_action_panel">
                    <div class="team_login_banner">
                        <img src="admin/images/teams/<?php echo $user_data['team_logo']; ?>" alt="">
                    </div>
                    <div class="current_team_info_auction">
                        <h5><?php echo $user_data['team_name']; ?></h5>
                        <h5>Budget :- 100 Cr</h5>
                        <h5 id="current_budget_of_team">Current Budget :- 0 Cr</h5>
                        <!-- <input type="text" id="total_players"> -->
                        <h5 id="RTM">RTM :-
                            <?php if ($current_team_rtm == 0) {
                                echo "🎴 🎴 🎴";
                            } else if ($current_team_rtm == 1) {
                                echo "🎴 🎴";
                            } else if ($current_team_rtm == 2) {
                                echo "🎴";
                            } else {
                                echo "you rtm are completed";
                            } ?>
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- RTM CARD STYLE UNIQUE TO DESIGN -->
        <?php if ($current_team_rtm > 3) {
            ?>

            <?php
        } else { ?>

            <div class="rtm_card_style" id="rtm_style">
                <div class="rtm_card">
                    <input type="hidden" id="rtm_check" value="<?php echo $current_team_rtm; ?>">
                    <h3>🎴</h3>
                </div>
            </div>

        <?php } ?>

    <?php } else { ?>
        <!-- Congratulation Animation Here -->
        <div class="congrats_div">
            <div class="congrats_text">
                <div class="congrats">🎉 Congratulations! 🎉</div>
                <h1>🎉 You Qualify for Playoff Rounds! 🎉</h1>
            </div>
            <button>Go To Make Playing XI</button>
        </div>
    <?php } ?>

    <!-- JavaScript to Fetch Player Data -->
    <!-- Fetch The Bid Amount -->
    <script>
        // Function to fetch live bid details
        function fetch_team_data() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "fetch_condition.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (this.status === 200) {
                    let response = JSON.parse(this.responseText);
                    if (response.status === "success") {


                        const SquadCount = response.data.squad_members;
                        const TeamBudget = response.data.team_budget;
    

                        if (SquadCount == 15) {
                            document.querySelector(".panel_container").style.display = 'none';
                            document.querySelector('.congrats_div').style.display = 'flex';
                        }
                        else {
                            document.querySelector(".panel_container").style.display = 'flex';
                            document.querySelector('.congrats_div').style.display = 'none';
                        }

                        // DisQualify System
                        if (SquadCount < 15 || TeamBudget < 0) {
                            document.querySelector('.congrats_div').style.display = 'flex';
                            document.querySelector(".congrats").innerHTML = "👋 See you next season ! 🖐️";
                            document.querySelector(".congrats").style.color = "red";
                            document.querySelector(".panel_container").style.display = 'none';
                            document.getElementById("quali_error").innerHTML = "🤞 You'r Disqualify for Playoff ! 🤙";
                        }




                    }
                }

            };

            xhr.send();
        }



        // Auto-refresh bid every 3 seconds
        setInterval(fetch_team_data, 10);


    </script>

    <!-- Fetch The Bid Amount -->
    <script>
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
                        document.getElementById("current_budget_of_team").innerHTML = `Current Budget :- ${response.data.budget} Cr`;

                        // ✅ Bid Button Hide/Show Logic
                        let currentTeamId = document.getElementById("team_id").value; // लॉगिन टीम ID
                        let bidTeamId = response.data.team_id; // जिसने बिड किया
                        let retainTeam = response.data.retain;

                        let teamBudget = parseFloat(response.data.budget); // टीम का बजट (Convert to number)
                        let currentBidAmount = parseFloat(response.data.bid_amount); // बिड की राशि (Convert to number)

                        const RTMShow = document.getElementById("rtm_style");
                        const RTMCheck = document.getElementById("rtm_check").value;

                        if (RTMCheck == 3) {
                            RTMShow.style.display = 'none';
                        } else {
                            if (currentTeamId == retainTeam) {
                                RTMShow.style.display = "block";
                            } else {
                                RTMShow.style.display = "none";
                            }
                        }

                        // ✅ Bid Button Hide/Show Based on Budget
                        if (currentTeamId == bidTeamId || teamBudget < currentBidAmount) {
                            document.querySelector(".bid_button").style.display = "none"; // बिड बटन हटा दो
                        }
                        else {
                            document.querySelector(".bid_button").style.display = "block";
                        }
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
        setInterval(fetchBidDetails, 500);

        // Click event for bid button
        document.querySelector(".bid_stats button").addEventListener("click", placeBid);

    </script>

    <script>
        function fetchPlayerData() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "fetch_player.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (this.status === 200) {
                    let response = JSON.parse(this.responseText);

                    // Check The RTM OF Current Team

                    if (response.status === "success") {



                        document.getElementById("player_info").innerHTML = `
                    <div class="player_banner">
                        <img src="admin/images/players/${response.data.player_pic ? response.data.player_pic : 'default_player_img.png'}" alt="">
                    </div>
                    <div class="player_stats">
                        <h3>${response.data.player_name}</h3>
                        <h3><span>Specialization :- </span> ${response.data.category} </h3>
                        <h3><span>Base Price :- </span> ${response.data.base_price} Cr</h3>
                    </div>
                `;
                    } else {
                        document.getElementById("player_info").innerHTML = `<h2>${response.message}</h2>`;
                    }
                }
            };

            xhr.send();
        }

        // Fetch player data every 3 seconds
        setInterval(fetchPlayerData, 500);

        // Fetch immediately when page loads
        fetchPlayerData();

    </script>

    <!-- Fetch Live Count Of Team Member -->
    <script>
        function fetchOrderCount() {
            $.ajax({
                url: "fetchteam_squad.php",
                method: "GET",
                success: function (data) {
                    $("#SquadCount").text(data);
                }
            });
        }

        // Fetch order count every 3 seconds
        setInterval(fetchOrderCount, 500);

        // Fetch immediately when the page loads
        fetchOrderCount();
    </script>






</body>

</html>