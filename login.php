<?php
require("prices.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main>
        <section class="loginWindow">
            <?php
            // Check if the session variable "incorrectKey" is set, and if it's true
            if (isset($_SESSION["incorrectKey"])) {
                if ($_SESSION["incorrectKey"] == true) {
                    // Unset the session variable "incorrectKey"
                    unset($_SESSION["incorrectKey"]);
                    // Echo a message to the user indicating that the API key is incorrect
                    echo "key incorrect";
                }
            }
            // Check if the session variable "incorrectName" is set, and if it's true
            if (isset($_SESSION["incorrectName"])) {
                if ($_SESSION["incorrectName"] == true) {
                    // Unset the session variable "incorrectName"
                    unset($_SESSION["incorrectName"]);
                    // Echo a message to the user indicating that they are not an admin
                    echo "you are not an admin";
                }
            }
            ?>
            <form action="loginVerification.php" method="POST">
                <div class="nameSection">
                    <label for="name">name</label>
                    <input class="nameSubmit inputWindow" type="text" name="name" id="name" placeholder="name" required>
                </div>
                <div class="keySection">
                    <label for="key">api_key</label>
                    <input class="keySubmit inputWindow" type="key" name="key" id="password" placeholder="api_key" required>
                </div>
                <button type="submit" name="submit" class="loginSubmit">login</button>
            </form>
        </section>
    </main>

</body>

</html>
