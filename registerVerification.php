<?php
require("prices.php");

// Check if the form parameter "key" is set
if (isset($_POST["key"])) {
    // Sanitize the user input
    $name = htmlspecialchars($_POST["name"]);
    $key = htmlspecialchars($_POST["key"]);

    // Prepare an INSERT statement to insert a new record into the "admin" table
    $stmt = $database->prepare("INSERT INTO 'admin' ('name', 'api_key')  values(?, ?)");

    // Bind the user input to the statement parameters
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $key);
    // Execute the statement
    $stmt->execute();

    // Redirect to the login page
    header("location: login.php");
}
