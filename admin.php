<?php

declare(strict_types=1);
require("prices.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <a class="resetBooking warning">Reset all bookings</a>
    <script src="script.js"></script>
    <form action="updateFeaturePrices.php" method="POST">
        <h4>features</h4>
        <?php foreach ($features as $feature) : ?>
            <div class="feature">
                <input type="input" name="<?php echo $feature['feature']; ?>" value="<?php echo $feature['price']; ?>">
                <?php echo $feature["feature"] ?>
            </div>
        <?php endforeach ?>
        <input type="submit">
    </form>
    <form action="updateRoomPrices.php" method="POST">
        <h4>Rooms</h4>
        <?php foreach ($rooms as $room) : ?>
            <div class="feature">
                <input type="input" name="<?php echo $room["room"]; ?>" value="<?php echo $room['price']; ?>">
                <?php echo $room["room"] ?>
            </div>
        <?php endforeach ?>
        <input type="submit">
    </form>

</body>

</html>
