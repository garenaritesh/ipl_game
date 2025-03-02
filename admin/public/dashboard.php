<?php

include("panel.php");

// All Applications

// Count All Things have in IPL Data In Database.

// Count Players 
$total_players = mysqli_num_rows(mysqli_query($db, "select * from players"));

// Count Teams 
$total_teams = mysqli_num_rows(mysqli_query($db, "select * from teams"));

// Total Spent Money On Auction
$total_spentMoney = mysqli_query($db, "select sum(price) as spent_amount from live_auction");


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
        --textfav-color: rgb(1, 1, 30);
        --epcl-input-bg-color: #F9F9FE;
        --box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        --header-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
    }


#spent_amount {
    width: 300px;
}

    .forms_overview {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: start;
        gap: 2rem;
        /* border: 1px solid black; */
    }

    .forms_overview .forms_overview_box {
        padding: 30px 15px;
        background: white;
        border-radius: 10px;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        display: flex;
        align-items: center;
        justify-content: space-around;
        gap: 2rem;
        width: 250px;
    }

    .forms_overview .forms_overview_box .box_info p {
        color: var(--epcl-black-color);
        font-size: 12px;
        font-weight: 400;
    }

    .forms_overview .forms_overview_box i {
        font-size: 40px;
        font-weight: 400;
        color: var(--epcl-black-color);
        padding: 10px;
        border-radius: 50%;
        background: var(--epcl-input-bg-color);
    }

    .forms_overview .forms_overview_box h1 {
        color: var(--textfav-color);
    }

    .forms_overview .forms_overview_box p {
        color: var(--textfav-color);

    }

    .balance {
        width: 100%;
        background: var(--white-color);
        box-shadow: var(--box-shadow);
        padding: 20px;
        margin-top: 2.5%;
        margin-bottom: 2.5%;
    }

    .balance .balance_box button {
        padding: 10px 50px;
        background: black;
        color: var(--white-color);
        cursor: pointer;
        border: none;
        outline: none;
        font-size: 16px;
        font-weight: 600;
        border-radius: 3px;
    }

    .balance .balance_box div {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }

    .balance h4 {
        font-size: 25px;
        font-weight: 600;
        color: var(--epcl-black-color);
    }

    .balance .balance_box {
        display: flex;
        gap: 1rem;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding: 15px;
        height: 100px;
    }

    .balance .balance_box i {
        font-size: 25px;
        font-weight: 600;
        color: var(--epcl-black-color);
    }


    .balance .balance_box p {
        font-size: 50px;
        font-weight: 600;
        color: var(=--epcl-titles-color);
    }

    /* Responsive */
    @media(max-width: 420px) {
        .forms_overview {
            display: grid;
            grid-template-columns: auto;
            grid-template-rows: auto;
        }

        .balance .balance_box button {
            padding: 0.5rem;
        }
    }
</style>

<h4>Dashboard</h4>

<div class="forms_overview">
    <!-- Total Applications -->
    <div class="forms_overview_box" id="total_application">
        <i class='bx bxs-user-pin'></i>
        <div class="box_info">
            <h1><?php echo $total_players; ?></h1>
            <p>Total Players</p>
        </div>
    </div>
    <!-- Past Month Total Applications -->
    <div class="forms_overview_box" id="past_month">
        <i class='bx bxl-graphql'></i>
        <div class="box_info">
            <h1><?php echo $total_teams; ?></h1>
            <p>Total Teams</p>
        </div>
    </div>
    <!-- Past Week Total Applications -->
    <div class="forms_overview_box" id="spent_amount">
        <i class='bx bxs-pie-chart-alt'></i>
        <div class="box_info">
            <h1><?php if ($row = mysqli_fetch_assoc($total_spentMoney)) {
                echo number_format($row['spent_amount'], 2) . " Cr ";
            } else {
                echo "0";
            }
            ; ?>
            </h1>
            <p>Spent Money</p>
        </div>
    </div>
    <!-- Today Day Total Applications -->
    <!-- <div class="forms_overview_box" id="today">
        <i class='bx bx-time'></i>
        <div class="box_info">
            <h1><?php echo 500; ?></h1>
            <p>Today</p>
        </div>
    </div> -->
</div>


<!-- Account Balance

<div class="balance">
    <h4>Account Balance</h4>
    <div class="balance_box">
        <div>
            <i class='bx bx-rupee'></i>
`
        </div>
        <button id="withdraw_btn">Withdraw</button>
    </div>


</div> -->


<!-- Total Form Of Which is this  -->