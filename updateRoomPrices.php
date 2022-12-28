<?php
require("prices.php");
$key = 1;
foreach ($_POST as $price) {
    $stmt = $database->prepare("UPDATE hotel_rooms set price = ? where id = ?");
    $stmt->bindParam(1, $price);
    $stmt->bindParam(2, $key);
    $stmt->execute();
    $key++;
}
header("location:admin.php");
