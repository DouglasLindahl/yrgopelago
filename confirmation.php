
<?php require("prices.php"); ?>
<?php

$bookedFeatures = [];
foreach ($_SESSION["features"] as $key => $feature) {
    array_push($bookedFeatures, ["name" => $feature, "cost" => $features[$key]["price"]]);
};
$bookingInfo = [
    "island" => $hotelInfo["island"],
    "hotel" => $hotelInfo["hotel"],
    "arrival_date" => $_SESSION["booking"]["arrivalDate"],
    "departure_date" => $_SESSION["booking"]["departureDate"],
    "total_cost" => $_SESSION["totalCost"],
    "stars" => $hotelInfo["stars"],
    "features" => $bookedFeatures,
    "additional_info" => $hotelInfo["info"]
];

$bookingInfo = json_encode($bookingInfo);
header('Content-type: application/json');
echo $bookingInfo;
?>
