<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

include("../admin/db.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


if (isset($_POST['send'])) {


    $email = $_POST['email'];

    // Main Script OF PHP Very Secure Code Here
    // Don't Change without give permission

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
        $mail->Body = "Passmate Account Password Is :-".$email_data['password'] 
                       . "Go Back to Passmate then submit login details...".
                       "Thanks , Your Brother" ;
        $mail->send();

        echo "
        <script>alert('Send Mail successFully');
          document.location.href = 'login.php'</script>
    
         ";
    } else {
        echo "<script>
              alert('Email Not Exist');

              window.location.href = 'forgot_password.php';
              </script>
           ";
    }

}

?>