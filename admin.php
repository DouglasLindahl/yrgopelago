<?php

declare(strict_types=1);
require("prices.php");


if (isset($_POST)) {
    $key = 1;
    foreach ($_POST as $feature) {
        $features[$key]["price"] = $feature;
        echo "<br>";
        echo $features[1]["price"];
        echo "<br>";
        echo $feature;
        echo "<br>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <a class="resetBooking warning">Reset all bookings</a>
    <script src="script.js"></script>
    <form action="admin.php" method="POST">
        <?php foreach ($features as $feature) : ?>
            <div class="feature">
                <input type="input" name="<?php echo $feature['feature']; ?>" value="<?php echo $feature['price']; ?>">
                <?php echo $feature["feature"] ?>
            </div>
        <?php endforeach ?>
        <input type="submit">
    </form>
</body>

</html>
