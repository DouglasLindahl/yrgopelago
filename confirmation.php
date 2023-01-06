<?php require("prices.php") ?>
<?php
$bookingInfo = [];
$_SESSION["booking"]["room"] = $rooms[intval($_SESSION["booking"]["room"]) - 1]["room"];
$bookingInfo = json_encode(array_merge($bookingInfo, $hotelInfo, $_SESSION["booking"], $_SESSION["features"]));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="index.php">
        < return to main page</a>
            <h1>Booking information</h1>
            <?php echo "<pre>";
            echo ($bookingInfo) ?>
</body>

</html>
