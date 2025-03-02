<!-- Header OF Page or Web -->

<?php

include('config/header.php');

// Auction Login


if (isset($_POST['team_login_auction'])) {
    $username = $_POST['team_email'];

    $sql = "select * from auction_panel where team_email ='$username'";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result)) {
        $_SESSION['team_auction_panel_login'] = $username;
        echo "<h1>Login Successfully</h1>";
        header("location:auction_panel.php");
    } else {
    
        @$error_message = "Your Team Not In Auction";

        $redirectUrl = "index.php";
        $timeout = 500;

    }
}

?>

<!-- Main Content Here Means Landing Page Od this project here -->


<section class="actions">
    <form action="#" method="post">
        <p style="text-align: center; font-size: 1rem; font-weight: 600; margin: 1rem 0;"><?php echo @$error_message;?></p>
        <input type="hidden" name="team_email" value="<?php echo $user_data['team_email']?>">
        <button name="team_login_auction">Join Auction</button>
    </form>
    <a href="users/logout.php">Logout</a>
</section>