<?php
require(__DIR__ . "/prices.php");
$totalCost = 0;


$departureDate = strtotime($_POST["departureDate"]);
$arrivalDate = strtotime($_POST["arrivalDate"]);
$howManyDays = round(($departureDate - $arrivalDate) / (60 * 60 * 24));

$stmt = $database->prepare("SELECT * from guests");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

for ($y = 0; $y < count($rooms); $y++) {
    echo ("room " . $y);
    for ($i = 0; $i < count($result); $i++) {
        for ($x = date("d", strtotime($result[$i]["arrival_date"])); $x <= date("d", strtotime($result[$i]["departure_date"])); $x++) {
            //add booked days in correct rooms to array
        }
    }
}

foreach ($_POST as $key => $item) {
    if ($key != "arrivalDate" && $key != "departureDate") {
        if ($key == "roomSelect") {
            $totalCost += (intval($rooms[$item - 1]["price"]) * $howManyDays);
        } else {
            $totalCost += intval($item);
        }
    }
}
$_SESSION["totalCost"] = $totalCost;
$_SESSION["booking"] = [
    "room" => $_POST["roomSelect"],
    "arrivalDate" => $_POST["arrivalDate"],
    "departureDate" => $_POST["departureDate"],
    "cost" => $_SESSION["totalCost"]
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
    <form action="paymentverification.php" method="POST">
        <input type="text" name="name" placeholder="name">
        <input type="text" name="api_key" placeholder="api_key">
        <button type="submit">submit</button>
    </form>
</body>

</html>
