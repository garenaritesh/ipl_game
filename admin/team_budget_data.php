<?php

include("db.php");

$sql = "select sum(price) as total_price from live_auction";
$res = mysqli_query($db, $sql);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    while ($row = mysqli_fetch_assoc($res)) {
        ?>

        <h3> budget <?php echo $row['total_price'] ?></h3>

    <?php } ?>

</body>

</html>