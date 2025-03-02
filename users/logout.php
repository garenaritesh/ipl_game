<?php

session_start();
unset($_SESSION['logins']);
unset($_SESSION['admin_id']);
header("Location: login.php"); // Redirect to admin login
exit();
?>