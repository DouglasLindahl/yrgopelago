<?php

// Require the prices file
require(__DIR__ . "/prices.php");

// Initialize the total cost to 0
$totalCost = 0;

// Convert the arrival and departure dates to timestamps
$departureDate = strtotime($_POST["departureDate"]);
$arrivalDate = strtotime($_POST["arrivalDate"]);

// Calculate the number of days between the arrival and departure dates
$howManyDays = round(($departureDate - $arrivalDate) / (60 * 60 * 24));

// Select all rows from the guests table
$stmt = $database->prepare("SELECT * from guests");
$stmt->execute();

// Fetch the results as an associative array
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Initialize the bookedDays array with three empty subarrays
$bookedDays = [
    1 => [],
    2 => [],
    3 => [],
];

var_dump($_POST);
// Loop through each guest in the result array
foreach ($result as $e) {
    // Loop through each subarray in the bookedDays array
    foreach ($bookedDays as $x => $days) {
        // Loop through the range of days between the guest's arrival and departure dates
        for ($i = date("d", strtotime($e["arrival_date"])); $i <= date("d", strtotime($e["departure_date"])); $i++) {
            // If the guest's room matches the key of the current subarray, add the day to the subarray
            if (array_keys($bookedDays)[$x - 1] == $e['room_id']) {
                array_push($bookedDays[$x], intval($i));
            }
        }
    }
}

// Loop through the range of days between the arrival and departure dates from the form
for ($i = date("d", strtotime($_POST['arrivalDate'])); $i <= date("d", strtotime($_POST['departureDate'])); $i++) {
    // If any of these days are found in the bookedDays subarray, return to main page
    if (in_array($i, $bookedDays[$_POST["roomSelect"]])) {
        header("location:index.php");
        exit;
    }
}


// Loop through each POST parameter
foreach ($_POST as $key => $item) {
    // If the parameter is not the arrival or departure date
    if ($key != "arrivalDate" && $key != "departureDate") {
        // If the parameter is the room selection
        if ($key == "roomSelect") {
            // Add the cost for that room for the number of days to the total cost
            $totalCost += (intval($rooms[$item - 1]["price"]) * ($howManyDays + 1));
        } else {
            // Otherwise, just add the value of the parameter to the total cost
            $totalCost += intval($item);
        }
    }
}

// Save the total cost and booking details in the session
$_SESSION["totalCost"] = $totalCost;
$_SESSION["booking"] = [
    "room" => $_POST["roomSelect"],
    "arrivalDate" => $_POST["arrivalDate"],
    "departureDate" => $_POST["departureDate"],
    "cost" => $_SESSION["totalCost"],
];
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
    <h3>Please provide your name and API_KEY</h3>
    <h3>total cost: $<?php echo $totalCost ?></h3>
    <form action="paymentverification.php" method="POST">
        <input type="text" name="name" placeholder="name">
        <input type="text" name="api_key" placeholder="api_key">
        <button type="submit">pay</button>
    </form>
</body>

</html>
