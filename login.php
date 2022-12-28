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
            if (isset($_SESSION["incorrectPassword"])) {
                if ($_SESSION["incorrectPassword"] == true) {
                    unset($_SESSION["incorrectPassword"]);
                    echo "password incorrect";
                }
            }
            if (isset($_SESSION["incorrectEmail"])) {
                if ($_SESSION["incorrectEmail"] == true) {
                    unset($_SESSION["incorrectEmail"]);
                    echo "that email does not exist";
                }
            }
            ?>
            <form action="loginVerification.php" method="POST">
                <div class="emailSection">
                    <label for="email">Email</label>
                    <input class="emailSubmit inputWindow" type="email" name="email" id="email" placeholder="example@gmail.com" required>
                </div>
                <div class="passwordSection">
                    <label for="password">Password</label>
                    <input class="passwordSubmit inputWindow" type="password" name="password" id="password" placeholder="password" required>
                </div>
                <button type="submit" name="submit" class="loginSubmit">login</button>
            </form>
        </section>
    </main>
</body>

</html>
