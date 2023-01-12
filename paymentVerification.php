<?php

declare(strict_types=1);
require(__DIR__ . "/hotelFunctions.php");
require(__DIR__ . "/prices.php");
require(__DIR__ . '/vendor/autoload.php');
$database = new PDO("sqlite:database/hotel.db");

use Dotenv\Dotenv;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

$client = new Client();
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$_SESSION["booking"]["name"] = $_POST["name"];
// Make a POST request to the specified URL, with the user name and transfer code as form parameters
if (!isValidUuid(htmlspecialchars($_POST["transferCode"]))) {
    header("location:index.php");
    die();
}
$response = $client->request('POST', 'https://www.yrgopelago.se/centralbank/transferCode', [
    'form_params' => [
        //check transferCode
        "transferCode" => $_POST["transferCode"], "totalcost" => $_SESSION["totalCost"]
    ]
]);
$deposit = $response->getBody()->getContents();
if (strstr($deposit, "error")) {
    header("location:index.php");
} else {
    // Make a POST request to the specified URL, with the user name and transfer code as form parameters
    $response = $client->request('POST', 'https://www.yrgopelago.se/centralbank/deposit', [
        'form_params' => [
            "user" => "Douglas", "transferCode" => $_POST["transferCode"]
        ]
    ]);
    $deposit = $response->getBody()->getContents();



    // Prepare an INSERT statement to insert a new record into the "guests" table
    $stmt = $database->prepare("INSERT INTO guests ('room_id', 'name', 'arrival_date', 'departure_date', 'total_cost')  values(?, ?, ?, ?, ?)");

    // Bind the session variables to the statement parameters
    $stmt->bindParam(1, $_SESSION["booking"]["room"]);
    $stmt->bindParam(2, $_SESSION["booking"]["name"]);
    $stmt->bindParam(3, $_SESSION["booking"]["arrivalDate"]);
    $stmt->bindParam(4, $_SESSION["booking"]["departureDate"]);
    $stmt->bindParam(5, $_SESSION["booking"]["cost"]);
    // Execute the statement
    $stmt->execute();

    // Prepare a SELECT statement to fetch all records from the "guests" table
    $stmt = $database->prepare("SELECT * from guests");
    // Execute the statement
    $stmt->execute();
    // Fetch the result as an associative array
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Initialize an empty array
    $datePeriod = [];

    // Iterate over the result array
    foreach ($result as $guest) {
        // Extract the day of the month from the arrival and departure dates
        $datePeriod["arrival_date"] = $arrivalDate = date("d", intval(strtotime($guest["arrival_date"])));
        $datePeriod["departure_date"] = $departureDate = date("d", intval(strtotime($guest["departure_date"])));
        // Set the "room" element to the session variable "room"
        $datePeriod["room"] = $room = $_SESSION["booking"]["room"];
    }

    // Read the contents of the "guests.json" file
    $guests = file_get_contents("guests.json");
    // Decode the JSON string into a PHP array
    $guests = json_decode($guests);
    // Add the date period array to the "guests" element of the array
    array_push($guests->{'guests'}, $datePeriod);
    // Encode the array back into a JSON string
    $guests = json_encode($guests);
    // Write the JSON string back to the "guests.json" file
    file_put_contents("guests.json", $guests);

    // Redirect to the confirmation page
    $bookedFeatures = [];
    foreach ($_SESSION["features"] as $key => $feature) {
        array_push($bookedFeatures, ["name" => $feature, "cost" => $features[$key]["price"]]);
    };
    $_SESSION["bookingInfo"] =
        [
            "island" => $hotelInfo["island"],
            "hotel" => $hotelInfo["hotel"],
            "arrival_date" => $_SESSION["booking"]["arrivalDate"],
            "departure_date" => $_SESSION["booking"]["departureDate"],
            "total_cost" => $_SESSION["totalCost"],
            "stars" => $hotelInfo["stars"],
            "features" => $bookedFeatures,
            "additional_info" => $hotelInfo["info"]
        ];
    $bookingInfo = json_encode($_SESSION["bookingInfo"]);
    header('Content-type: application/json');
    echo $bookingInfo;

    //header("location:confirmation.php");
}
