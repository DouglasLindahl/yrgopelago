<?php

declare(strict_types=1);
$starsVisited = [];
$featuresUsed = [];
$totalCost = 0;
$numberOfDays = 0;
$longVisits = 0;

// If no filename is detected
if ($argc === 1) {
    echo "You should pass a .json file as a parameter (For example: 'php 04.php logbook.json')";
    die();
}

// Test it by regex
if (preg_match('/[0-9,a-z]+.json/', $argv[1])) {
    $logbook = $argv[1];
}

if (file_exists($logbook)) {
    // Two operations one the same line.
    $visits = json_decode(file_get_contents(__DIR__ . '/' . $logbook), true);
    $visits = $visits['vacation'];
} else {
    echo "No such file. \n";
    die();
}

// Sort logbook by arrivaldate.
usort($visits, function ($a, $b) {
    return $a['arrival_date'] > $b['arrival_date'] ? 1 : 0;
});
// Print the names of all hotels and their star rating
foreach ($visits as $visit) {
    // %s prints the argument as string, and %d as integer. The arguments are "consumed" in the order they are.
    printf("Arrival on %s at %s, where I used %d features. \n", $visit['arrival_date'], $visit['hotel'], count($visit['features']));

    // Check if user visited this starcategory before, if not, add it to starsVisited.
    if (!in_array($visit['stars'], $starsVisited)) {
        $starsVisited[] = $visit['stars'];
    }

    // Loop through the features array
    foreach ($visit['features'] as $feature) {
        if (!in_array($feature['name'], $featuresUsed)) {
            $featuresUsed[] = $feature['name'];
        }
    }

    // Count days
    $arrival = new DateTimeImmutable($visit['arrival_date']);
    $departure = new DateTimeImmutable($visit['departure_date']);
    $numberOfDays += $arrival->diff($departure)->format('%a');

    // Check if visit is at least four days
    if ($arrival->diff($departure)->format('%a') >= 4) {
        $longVisits += 1;
    }

    // Add cost to totalCost
    $totalCost += $visit['total_cost'];
}
echo "-----\n";
printf("During %d days, you have visited hotels of %d different star-categories while spending $%d,\nperhaps on some of the %d different features that you've used.\nYou also had %d visit(s) that were four days or longer\n", $numberOfDays, count($starsVisited), $totalCost, count($featuresUsed), $longVisits);
