<?php
require("prices.php");

// Check if the POST variables "name" and "key" are set
if (isset($_POST["name"]) && isset($_POST["key"])) {
    // Sanitize the POST variables and store them in local variables
    $name = htmlspecialchars($_POST["name"]);
    $key = htmlspecialchars($_POST["key"]);

    // Prepare a SELECT statement to fetch the record for the specified name from the "admin" table
    $stmt = $database->prepare("SELECT * FROM admin WHERE name like ?");
    // Bind the name parameter to the statement
    $stmt->bindParam(1, $name);
    // Execute the statement
    $stmt->execute();
    // Fetch the result as an associative array
    $admin = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if the name exists in the "admin" table
    if ($admin[0]["name"]) {
        // Check if the entered key matches the key in the "admin" table
        if (password_verify($key, $admin[0]["api_key"])) {
            // Set the session variable "loginVerified" to true
            $_SESSION["loginVerified"] = true;
            // Redirect to the admin page
            header("location:admin.php");
        } else {
            // Set the session variable "incorrectKey" to true
            $_SESSION["incorrectKey"] = true;
            // Redirect to the login page
            header("location:login.php");
        }
    } else {
        // Set the session variable "incorrectName" to true
        $_SESSION["incorrectName"] = true;
        // Redirect to the login page
        header("location:login.php");
    }
} else {
    // Redirect to the login page
    header("location:login.php");
}
