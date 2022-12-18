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

$totalCost = 0;
foreach ($_POST as $item) {
    if ($item != $_POST["transferCode"]) {
        $totalCost += intval($item);
    }
}
$_SESSION["totalCost"] = $totalCost;
echo $_SESSION["totalCost"];
if (isset($_POST["transferCode"])) {
    $response = $client->request('POST', 'https://www.yrgopelago.se/centralbank/transferCode', [
        'form_params' => [
            "transferCode" => $_POST["transferCode"], "totalcost" => $totalCost
        ]
    ]);
    $payment = $response->getBody()->getContents();
    $payment = json_decode($payment, true);
    echo "<pre>";
    var_dump($payment);

    if (key_exists("error", $payment)) {
        $_SESSION["payment_passed"] = false;
        header("location:index.php");
    } else {
        $_SESSION["payment_passed"] = true;
        echo "valid";
    }
}
