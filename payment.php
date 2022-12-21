<?php
session_start();
$totalCost = 0;
foreach ($_POST as $item) {
    $totalCost += intval($item);
}
$_SESSION["totalCost"] = $totalCost;
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
    <form action="paymentverification.php" method="POST">
        <input type="text" name="name" placeholder="name">
        <input type="text" name="api_key" placeholder="api_key">
        <button type="submit">submit</button>
    </form>
</body>

</html>
