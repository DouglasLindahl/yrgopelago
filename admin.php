<?php

declare(strict_types=1);
require("prices.php");
if (!isset($_SESSION["loginVerified"])) {
    header("location:index.php");
}
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
<?php
// Check if the session variable "loginVerified" is set
if ($_SESSION["loginVerified"]) :
?>

    <body>
        <a class="resetBooking warning">Reset all bookings</a>
        <script src="script.js"></script>
        <form action="updateFeaturePrices.php" method="POST">
            <h4>features</h4>
            <?php
            // Loop through the array of features
            foreach ($features as $feature) :
            ?>
                <div class="feature">
                    <input type="input" name="<?php echo $feature['feature']; ?>" value="<?php echo $feature['price']; ?>">
                    <?php echo $feature["feature"] ?>
                </div>
            <?php endforeach ?>
            <input type="submit">
        </form>
        <form action="updateRoomPrices.php" method="POST">
            <h4>Rooms</h4>
            <?php
            // Loop through the array of rooms
            foreach ($rooms as $room) :
            ?>
                <div class="feature">
                    <input type="input" name="<?php echo $room["room"]; ?>" value="<?php echo $room['price']; ?>">
                    <?php echo $room["room"] ?>
                </div>
            <?php endforeach ?>
            <input type="submit">
        </form>

        <section>
            <h3>economy</h3>
            <?php
            $stmt = $database->prepare("SELECT SUM((julianday(departure_date) +1) - julianday(arrival_date)) AS days_booked
                FROM guests where room_id = 1;");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_DEFAULT);
            echo "days booked: " . $result["days_booked"] . " / 31";
            ?>
        </section>
        <section>
            <h3>standard</h3>
            <?php
            $stmt = $database->prepare("SELECT SUM((julianday(departure_date) +1) - julianday(arrival_date)) AS days_booked
                FROM guests where room_id = 2;");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_DEFAULT);
            echo "days booked: " . $result["days_booked"] . " / 31";
            ?>
        </section>
        <section>
            <h3>luxury</h3>
            <?php
            $stmt = $database->prepare("SELECT SUM((julianday(departure_date) +1) - julianday(arrival_date)) AS days_booked
                FROM guests where room_id = 3;");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_DEFAULT);
            echo "days booked: " . $result["days_booked"] . " / 31";
            ?>
        </section>
        <section>
            <h3>total</h3>
            <?php
            $stmt = $database->prepare("SELECT SUM((julianday(departure_date) +1) - julianday(arrival_date)) AS days_booked
                FROM guests");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_DEFAULT);
            echo "total days booked: " . $result["days_booked"] . " / 93";
            ?>
        </section>
    </body>
<?php endif ?>


</html>
