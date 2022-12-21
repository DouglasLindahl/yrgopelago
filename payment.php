<?php
session_start();
$totalCost = 0;
var_dump($_POST);
echo "<br>";
echo "<br>";

$departureDate = strtotime($_POST["departureDate"]);
$arrivalDate = strtotime($_POST["arrivalDate"]);
$howManyDays = round(($departureDate - $arrivalDate) / (60 * 60 * 24));



foreach ($_POST as $key => $item) {
    if ($key != "arrivalDate" && $key != "departureDate") {
        if ($key == "roomSelect") {
            $totalCost += (intval($item) * $howManyDays);
        } else {
            $totalCost += intval($item);
        }
    }
}
echo "<br>";
echo $totalCost;
$_SESSION["totalCost"] = $totalCost;

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
