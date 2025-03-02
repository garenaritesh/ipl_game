<?php

session_start();
unset($_SESSION['admin_auction_panel_login']);
unset($_SESSION['team_email']);
header("Location: admin_auction_panel_login.php"); // Redirect to admin login
exit();

?>