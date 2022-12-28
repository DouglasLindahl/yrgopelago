<?php
session_start();
$database = new PDO("sqlite:database/hotel.db");
$hotelInfo = [
    "hotel" => "hotel",
    "stars" => 1
];
$rooms = [
    ["room" => "economy", "price" => 2],
    ["room" => "standard", "price" => 4],
    ["room" => "luxury", "price" => 6]
];


$features = [
    ["feature" => "pool access", "price" => 2],
    ["feature" => "breakfast buffet", "price" => 4],
    ["feature" => "fruit basket", "price" => 1],
    ["feature" => "sauna", "price" => 2],
    ["feature" => "wifi", "price" => 2],
    ["feature" => "mini fridge", "price" => 3],
    ["feature" => "daily newspaper", "price" => 1]
];
