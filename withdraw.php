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
        "user" => "Rune", "api_key" => "ab14cbb2-f550-46e6-97c2-bb7f0126733e", "amount" => 10
    ]
]);
$payment = $response->getBody()->getContents();
$payment = json_decode($payment, true);
echo "<pre>";
var_dump($payment);
