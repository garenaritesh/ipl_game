<!-- PHP SCRIPT -->

<?php

include('../admin/db.php');


if (isset($_REQUEST['register'])) {
    $fname = $_REQUEST['team_name'];
    $email = $_REQUEST['team_email'];
    $password = $_REQUEST['team_pass'];


    $team_logo = $_FILES['team_logo']['name'];
    move_uploaded_file($_FILES['team_logo']['tmp_name'], '../admin/images/teams/' . $team_logo);

    $sql = "insert into teams(team_name,team_email,team_pass,team_logo) values('$fname','$email','$password','$team_logo')";
    mysqli_query($db, $sql);
    header("location:login.php");


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sign Up </title>
    <link rel="stylesheet" href="css/style.css">
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
            <li onclick="location.href='login.php'">Sign In</li>
        </ul>
    </nav>


    <!-- Main Container Here -->

    <div class="container">
        <form action="#" method="post" class="form_container" enctype="multipart/form-data">
            <h2>Create Account</h2>
            <input type="text" name="team_name" required placeholder="Team">
            <input type="email" id="email" name="team_email" required placeholder="Team email">
            <label for="logo">Team Logo</label>
            <input type="file" required name="team_logo">
            <input type="text" id="password" name="team_pass" required placeholder="Team Password">
            <div class="password-feedback">
                <div id="length-feedback" class="feedback-line">At least 8 characters & contains both upper and lower
                    case letters</div>
                <div id="number-feedback" class="feedback-line">Contains at least one number</div>
                <div id="special-feedback" class="feedback-line">Contains at least one special character (e.g., @, #, $,
                    %, etc.)</div>
            </div>
            <div class="term">
                <input type="checkbox" id="terms-checkbox">
                I agree to the &nbsp; <a href="#" target="_blank">terms and conditions</a>.

            </div>
            <button name="register" id="submit-button">Create Account</button>
        </form>
    </div>

    <!-- Javascript contente here -->
    <!-- Validation Of Form -->
    <script>
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const submitButton = document.getElementById('submit-button');
        const termsCheckbox = document.getElementById('terms-checkbox');
        const lengthFeedback = document.getElementById('length-feedback');
        const numberFeedback = document.getElementById('number-feedback');
        const specialFeedback = document.getElementById('special-feedback');

        // Email validation regex
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const phoneRegex = /^(\+?\d{1,3}[-\s]?)?\(?\d{3}\)?[-\s]?\d{3}[-\s]?\d{4}$/;

        // Password validation criteria
        const lengthRegex = /.{8,}/;
        const uppercaseRegex = /[A-Z]/;
        const lowercaseRegex = /[a-z]/;
        const numberRegex = /[0-9]/;
        const specialRegex = /[!@#$%^&*(),.?":{}|<>]/;

        function validateEmail() {
            const emailValue = emailInput.value;
            const isValid = emailRegex.test(emailValue);
            emailInput.classList.toggle('valid', isValid);
            emailInput.classList.toggle('invalid', !isValid);
            return isValid;
        }


        function validatePassword() {
            const passwordValue = passwordInput.value;

            const isLengthValid = lengthRegex.test(passwordValue) && uppercaseRegex.test(passwordValue) && lowercaseRegex.test(passwordValue);
            const isNumberValid = numberRegex.test(passwordValue);
            const isSpecialValid = specialRegex.test(passwordValue);

            lengthFeedback.classList.toggle('valid', isLengthValid);
            lengthFeedback.classList.toggle('invalid', !isLengthValid);

            numberFeedback.classList.toggle('valid', isNumberValid);
            numberFeedback.classList.toggle('invalid', !isNumberValid);

            specialFeedback.classList.toggle('valid', isSpecialValid);
            specialFeedback.classList.toggle('invalid', !isSpecialValid);

            const isValid = isLengthValid && isNumberValid && isSpecialValid;
            passwordInput.classList.toggle('valid', isValid);
            passwordInput.classList.toggle('invalid', !isValid);
            return isValid;
        }

        function enableSubmitButton() {
            const isFormValid = validateEmail() && validatePassword() && termsCheckbox.checked;
            submitButton.disabled = !isFormValid;
            submitButton.classList.toggle('enabled', isFormValid);
        }

        emailInput.addEventListener('input', () => {
            validateEmail();
            enableSubmitButton();
        });


        passwordInput.addEventListener('input', () => {
            validatePassword();
            enableSubmitButton();
        });

        termsCheckbox.addEventListener('change', () => {
            enableSubmitButton();
        });
    </script>



</body>

</html>