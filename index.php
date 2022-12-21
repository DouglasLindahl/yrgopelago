<?php

declare(strict_types=1);
require(__DIR__ . "/hotelFunctions.php");
require(__DIR__ . "/prices.php");
require(__DIR__ . '/vendor/autoload.php');

// if (!$_SESSION["payment_passed"]) {
//     echo '<script>alert("payment unsuccessful")</script>';
// } else {
//     echo '<script>alert("payment successful")</script>';
// }
// echo 'Current PHP version: ' . phpversion();
$months = [
    ["january", 31],
    ["february", 28],
    ["march", 31],
    ["april", 30],
    ["may", 31],
    ["june", 30],
    ["july", 31],
    ["august", 31],
    ["september", 30],
    ["october", 31],
    ["november", 30],
    ["december", 31]
];
$days = [
    "monday",
    "tuesday",
    "wednesday",
    "thursday",
    "friday",
    "saturday",
    "sunday"
];
$currenMonth = 1;
$currenYear = 2023;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="settings.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <header>
        <section class="heroSection">
            <div class="heroImage"></div>
        </section>
    </header>
    <main>
        <section class="rooms">
            <?php foreach ($rooms as $room) : ?>
                <div class="room">
                    <h1><?php echo $room["room"] ?></h1>
                    <section class="calendar">
                    </section>
                </div>
            <?php endforeach ?>
        </section>

        <section class="booking">
            <form action="payment.php" method="POST">
                <select name="roomSelect" class="roomSelect">
                    <?php foreach ($rooms as $room) : ?>
                        <option value=<?php echo $room["price"] ?>><?php echo $room["room"] ?></option>
                    <?php endforeach ?>
                </select>
                <section class="dates">
                    <div>
                        <p>arrival</p>
                        <input type="date" name="arrivalDate" min="2023-01-01" max="2023-01-31">
                    </div>
                    <div>
                        <p>departure</p>
                        <input type="date" name="departureDate" min="2023-01-01" max="2023-01-31">
                    </div>
                </section>
                <section class=" features">
                    <?php foreach ($features as $feature) : ?>
                        <div class="feature">
                            <input type="checkbox" name=<?php echo $feature["feature"] ?> value=<?php echo $feature["price"] ?>>
                            <?php echo $feature["feature"] . " ($" . $feature["price"] . ")" ?>
                        </div>
                    <?php endforeach ?>
                </section>
                <button type="submit">submit</button>
            </form>
        </section>
    </main>
    <script src="calendar.js"></script>
</body>

</html>
