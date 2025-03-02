<?php

include("../db.php");
session_start();



if (isset($_POST['login'])) {
    $username = $_POST['admin_username'];
    $password = $_POST['admin_pass'];
    $sql = "select * from admin where admin='$username' and password='$password'";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result)) {
        $_SESSION['admin_login'] = $username;
        echo "<h1>Login Successfully</h1>";
        header("location:dashboard.php");
    } else {
        echo "
        <h1>Login Failed | Data Dose'nt match</h1>";

        $redirectUrl = "login_admin.php";
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
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../media/media.css">
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
        <h3>Campus<span>Corner</span></h3>
        <form action="#" method="post">
            <input type="text" name="admin_username" placeholder="Username" required>
            <input type="text" name="admin_pass" placeholder="Password" required>
            <button class="login" name="login">Login</button>
        </form>
    </div>

    <script>
        setTimeout(() => {
            window.location.href = "<?php echo $redirectUrl; ?>";
        }, <?php echo $timeout; ?>);
    </script>


</body>

</html>