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


$response = $client->request('POST', 'https://www.yrgopelago.se/centralbank/withdraw', [
    'form_params' => [
        "user" => $_POST["name"], "api_key" => $_POST["api_key"], "amount" => $_SESSION["totalCost"]
    ]
]);
$payment = $response->getBody()->getContents();
$payment = json_decode($payment, true);
if (array_key_exists("error", $payment)) {
    header("index.php");
}


$_SESSION["transfer_code"] = $payment["transferCode"];

//add money to my account---------------

$response = $client->request('POST', 'https://www.yrgopelago.se/centralbank/deposit', [
    'form_params' => [
        "user" => "Douglas", "transferCode" => $payment["transferCode"]
    ]
]);

$response = $response->getBody()->getContents();
$response = json_decode($response, true);
$_SESSION["booking"]["name"] = $_POST["name"];

$_SESSION["payment_passed"] = true;
$stmt = $database->prepare("INSERT INTO guests ('room_id', 'name', 'arrival_date', 'departure_date', 'total_cost')  values(?, ?, ?, ?, ?)");

$stmt->bindParam(1, $_SESSION["booking"]["room"]);
$stmt->bindParam(2, $_SESSION["booking"]["name"]);
$stmt->bindParam(3, $_SESSION["booking"]["arrivalDate"]);
$stmt->bindParam(4, $_SESSION["booking"]["departureDate"]);
$stmt->bindParam(5, $_SESSION["booking"]["cost"]);
$stmt->execute();


$stmt = $database->prepare("SELECT * from guests");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


$datePeriod = [];
foreach ($result as $guest) {
    $datePeriod["arrival_date"] = $arrivalDate = date("d", strtotime($guest["arrival_date"]));
    $datePeriod["departure_date"] = $departureDate = date("d", strtotime($guest["departure_date"]));
    $datePeriod["room"] = $room = $_SESSION["booking"]["room"];
}


$guests = file_get_contents("guests.json");
$guests = json_decode($guests);
array_push($guests->{'guests'}, $datePeriod);
$guests = json_encode($guests);
file_put_contents("guests.json", $guests);

header("location:confirmation.php");
