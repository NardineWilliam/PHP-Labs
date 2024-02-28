<?php
require_once "vendor/autoload.php";
$counter = new Counter(FILE_NAME);

session_start();
$visitorId = Visitor::getUniqueVisitorId();

if (!isset($_SESSION['visited']) || $_SESSION['visited'] !== $visitorId) {
    $counter->increment();
    $_SESSION['visited'] = $visitorId;
}

echo "Counted Unique Visitors: " . $counter->getCount();