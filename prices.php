<?php
session_start();
$database = new PDO("sqlite:database/hotel.db");

$x = $database->prepare("SELECT feature, price from features");
$x->execute();
$features = $x->fetchAll(PDO::FETCH_ASSOC);

$y = $database->prepare("SELECT room, price from hotel_rooms");
$y->execute();
$rooms = $y->fetchAll(PDO::FETCH_ASSOC);

$hotelInfo = [
    "island" => "island",
    "hotel" => "hotel",
    "stars" => 3,
    "info" => "thank you for staying at the hotel hotel"
];
