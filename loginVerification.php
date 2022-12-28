<?php
require("prices.php");

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = htmlspecialchars($_POST["email"]);
    $password = ($_POST["password"]);

    $stmt = $database->prepare("SELECT * FROM admin WHERE email LIKE ?");

    $stmt->bindParam(1, $email);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin["email"]) {
        if (password_verify($password, $admin["password"])) {
            $_SESSION["loginVerified"] = true;
            header("location:admin.php");
        } else {
            $_SESSION["incorrectPassword"] = true;
            header("location:login.php");
        }
    } else {
        $_SESSION["incorrectEmail"] = true;
        header("location:login.php");
    }
} else {
    header("location:login.php");
}
