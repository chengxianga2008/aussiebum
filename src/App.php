<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Model\DateDiff;

if (count($argv) <= 2) {
    echo "Usage: php App.php [date1] [date2]\n";
    exit;
}

try {
    $dateDiff = new DateDiff($argv[1], $argv[2]);
    $days = $dateDiff->computeDiff();
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
    exit;
}


if ($days > 1) {
    echo "$days days\n";
} else {
    echo "$days day\n";
}
