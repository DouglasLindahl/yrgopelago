<?php
require("prices.php");



$stmt = $database->prepare("DELETE from guests where id > 0");
$stmt->execute();
$guests = file_get_contents("guests.json");
$guests = json_decode($guests);
$guests->{'guests'} = [];
$guests = json_encode($guests);
file_put_contents("guests.json", $guests);
header("location:admin.php");
