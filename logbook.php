<?php

declare(strict_types=1);

require(__DIR__ . '/hotelFunctions.php');

//get the logbook.json file
$bookings = file_get_contents(__DIR__ . '/logbook.json');


// a function that prints out data from logbook.json
function createLogbookCards($bookings): void
{

    $bookings = json_decode($bookings, true);

    //loop through the data from logbook.json and put in a div
    foreach ($bookings as $booking) { ?>
<div class="card-item">
    <?php $island = $booking['island'];
            $hotel = $booking['hotel'];
            $arrivalDate = $booking['arrival_date'];
            $departureDate = $booking['departure_date'];
            $totalCost = $booking['total_cost'];
            $stars = $booking['stars'];
            $features = $booking['features'];
            $additional_info = $booking['additional_info'];


            echo  "Island: " . $island . "<br>" .
                "Hotel: "  . $hotel . "<br>" .
                "Arrival Date: " . $arrivalDate . "<br>" .
                "Departure Date: " . $departureDate . "<br>" .
                "Total Cost: " . $totalCost . "$" . "<br>" .
                "Stars: " . $stars . "<br>" .
                "Features:<br>";
            foreach ($features as $feature) {
                echo "name: " .
                    $feature['name'] . "<br>" .
                    "cost: " .
                    $feature['cost'] . "$" . "<br>";
            }
            echo "Additional info: " . $additional_info . "<br>"; ?> </div>
<?php }
}


//function that gets data from db and counts total cost for all bookings and the average cost and creates a div.
function createFactBox()
{
    $database = connect('/database/hotel.db');
    $statement = $database->prepare("SELECT * FROM guests");
    $statement->execute();

    $bookings = $statement->fetchAll(PDO::FETCH_ASSOC);

    $totalCost = 0;

    foreach ($bookings as $booking) {
        $totalCost += $booking['total_cost'];
    }
    $averageCost = $totalCost / count($bookings);
    $averageCost = round($averageCost); ?>

<div class="fact-box">
    <p>
        <?php echo "The total cost for all the bookings at Island Hotel is: " . $totalCost . "$" . " <br>
        The average cost per bookings is: " . $averageCost . "$"; ?>
    </p>
</div>
<?php
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="logbook.css">
    <title>Logbook</title>
</head>

<body>

    <div class="card">
        <h2>Visited hotels</h2>
        <?php createLogbookCards($bookings); ?>
        <h2>Island hotel fact box</h2>
        <?php createFactBox(); ?>
    </div>
    <div class="booking-page"><a href="index.php">Back to booking page</a></div>
</body>

</html>