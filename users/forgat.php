<!-- SESSIOn -->
<?php


include("../db.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['resetlink'])) {
    $email = $_POST['email'];

    $sql = "select * from users where email = '$email'";
    $res = mysqli_query($db, $sql);
    $check_email = mysqli_num_rows($res);
    $email_data = mysqli_fetch_assoc($res);

    if ($check_email > 0) {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'passmatestudentcare@gmail.com';
        $mail->Password = 'yajncncenlhsalxs'; // Your Gmail Password Of Sending Email Id Or Account
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('passmatestudentcare@gmail.com');
        $mail->addAddress($_POST['email']); // Add a recipient

        $mail->isHTML(true);

        $mail->Subject = $_POST['subject'];
        $mail->Body = "<div class='email_body' style='width: 100%; display: grid; grid-template-columns: auto; grid-template-rows: auto; align-items: center; justify-content: center; gap: 1rem;'>
                         <h2>Reset Password</h2> 
                         <div class='email_content' style='display: block;'>
                           <p>your  " . $email_data['email'] . " account reset passsword link here , please click the link below </p>
                           <a href='http://localhost/youtube/userauth/public/newpass.php?change_pass=".$email_data['id']."' style=' padding: 1rem; background: #000; color: #fff; text-decoration: none; display: flex; align-items: center; justify-content: center; width: 200px; text-align: center;'>Reset Password</a>
                         </div>
                       </div>";
        $mail->send();

        echo "
        <script>alert('Send Mail successFully');
          document.location.href = 'forgat.php'</script>
    
         ";
    } else {
        echo "<script>
              alert('Email Not Exist');

              window.location.href = 'forgat.php';
              </script>
           ";
    }



}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Reset Password </title>
    <link rel="stylesheet" href="../css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <!-- Body Content Here -->

    <!-- Header -->
    <nav>
        <div class="logo">
            <h1>user<span>Auth</span> </h1>
        </div>
        <ul>
            <li onclick="location.href='register.php'">Create Account</li>
        </ul>
    </nav>


    <!-- Main Container Here -->

    <div class="container">
        <form action="#" method="post" class="form_container">
            <h2>Reset Passowrd</h2>
            <input type="email" name="email" required placeholder="email">
            <button name="resetlink">Submit</button>
        </form>
    </div>

    <!-- Javascript contente here -->

</body>

</html>