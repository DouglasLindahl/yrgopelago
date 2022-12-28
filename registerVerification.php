<?php
require("prices.php");

if (isset($_POST["password"])) {
    $password = password_hash(filter_var(($_POST["password"])), 1);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $first_name = htmlspecialchars($_POST["first_name"]);
    $last_name = htmlspecialchars($_POST["last_name"]);
    $stmt = $database->prepare("INSERT INTO 'admin' ('first_name', 'last_name', 'email', 'password')  values(?, ?, ?, ?)");

    $stmt->bindParam(1, $first_name);
    $stmt->bindParam(2, $last_name);
    $stmt->bindParam(3, $email);
    $stmt->bindParam(4, $password);
    $stmt->execute();

    header("location: login.php");
}
