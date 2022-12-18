<?php

declare(strict_types=1);
require(__DIR__ . "/hotelFunctions.php");
require(__DIR__ . "/prices.php");
require(__DIR__ . '/vendor/autoload.php');

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
$_SESSION["transfer_code"] = $payment["transferCode"];


echo $_SESSION["transfer_code"] . " ($" . $_SESSION["totalCost"] . ")" . " will be added to account!";
//add money to my account---------------




$_SESSION["payment_passed"] = true;
header("location:index.php");
