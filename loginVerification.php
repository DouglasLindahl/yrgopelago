<?php
require("prices.php");

// Check if the POST variables "name" and "key" are set
if (isset($_POST["name"]) && isset($_POST["key"])) {
    // Sanitize the POST variables and store them in local variables
    $name = htmlspecialchars($_POST["name"]);
    $key = htmlspecialchars($_POST["key"]);


    $stmt = $database->prepare("SELECT * FROM admin WHERE name like ?");
    $stmt->bindParam(1, $name);
    $stmt->execute();
    $admin = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if the name exists in the "admin" table
    if ($admin[0]["name"]) {
        // Check if the entered key matches the key in the "admin" table
        if (password_verify($key, $admin[0]["api_key"])) {
            // Set the session variable "loginVerified" to true
            $_SESSION["loginVerified"] = true;
            header("location:admin.php");
        } else {
            // Set the session variable "incorrectKey" to true
            $_SESSION["incorrectKey"] = true;
            header("location:login.php");
        }
    } else {
        // Set the session variable "incorrectName" to true
        $_SESSION["incorrectName"] = true;
        header("location:login.php");
    }
} else {
    header("location:login.php");
}
