<?php

session_start();
unset($_SESSION['team_auction_panel_login']);
unset($_SESSION['team_email']);
header("Location: index.php"); // Redirect to admin login
exit();

?>