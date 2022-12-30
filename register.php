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

<?php if ($_SESSION["loginVerified"]) :
?>

    <body>
        <main>
            <form action="registerVerification.php" method="POST">
                <div class="name">
                    <label for="name">name</label>
                    <input type="text" name="name" placeholder="name">
                </div>
                <div class="key">
                    <label for="key">api_key</label>
                    <input type="text" name="key" placeholder="key">
                </div>
                <button type="submit" name="submit" class="registerSubmit">register admin</button>
            </form>
        </main>
    </body>
<?php endif
?>

</html>
