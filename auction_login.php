<?php

include("admin/db.php");
session_start();



if (isset($_POST['team_login_auction'])) {
    $username = $_POST['team_email'];

    $sql = "select * from auction_panel where team_email ='$username'";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result)) {
        $_SESSION['team_auction_panel_login'] = $username;
        echo "<h1>Login Successfully</h1>";
        header("location:auction_panel.php");
    } else {
        echo "
        <h1>Login Failed | Data Dose'nt match</h1>";

        $redirectUrl = "auction_login.php";
        $timeout = 500;

    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login Admin </title>
    <link rel="stylesheet" href="admin/style.css">
    <link rel="stylesheet" href="admin/media/media.css">
</head>

<body>

    <style>
        a {
            transition: all ease 0.2s;
            width: 100%;
            padding: 10px;
            display: flex;
            justify-content: center;
            align-content: center;
            color: black;
        }

        a:hover {
            background: black;
            color: white;
        }
    </style>

    <!-- Body content Here -->
    <div class="form_container">
        <h3>Team Login</h3>
        <form action="#" method="post">
            <input type="text" name="team_email" placeholder="email" required>
            <button class="login" name="team_login_auction">Login</button>
        </form>
    </div>

    <script>
        setTimeout(() => {
            window.location.href = "<?php echo $redirectUrl; ?>";
        }, <?php echo $timeout; ?>);
    </script>


</body>

</html>