<?php
require("prices.php");
if (!isset($_SESSION["loginVerified"])) {
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php if ($_SESSION["loginVerified"]) : ?>

    <body>
        <main>
            <form action="registerVerification.php" method="POST">
                <div class="firstName">
                    <label for="first_name">first name</label>
                    <input type="text" name="first_name" placeholder="first name">
                </div>
                <div class="lastName">
                    <label for="last_name">last name</label>
                    <input type="text" name="last_name" placeholder="last name">
                </div>
                <div class="email">
                    <label for="email">email</label>
                    <input type="email" name="email" placeholder="email">
                </div>
                <div class="password">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="password">
                </div>
                <button type="submit" name="submit" class="registerSubmit">register account</button>
            </form>
        </main>
    </body>
<?php endif ?>

</html>
