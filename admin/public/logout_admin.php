<?php

session_start();
unset($_SESSION['admin_login']);
unset($_SESSION['admin_id']);
header("Location: login_admin.php"); // Redirect to admin login
exit();

?>