<?php
require(__DIR__ . "/hotelFunctions.php");

$rooms = [
    "economy",
    "standard",
    "luxury"
]



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="settings.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <header>
        <section class="heroSection">
            <div class="heroImage"></div>
        </section>
    </header>
    <main>

        <section class="rooms">
            <section class="room">

            </section>
        </section>
        <form action="" method="POST">


            <select name="roomSelect" class="roomSelect">
                <?php foreach ($rooms as $room) : ?>
                    <option><?php echo $room ?></option>
                <?php endforeach ?>
            </select>


        </form>
    </main>
</body>

</html>
