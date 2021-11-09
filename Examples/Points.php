<?php

use CareCloud\ApiException;
use CareCloud\SDK\Config;
use CareCloud\SDK\CareCloud;
use CareCloud\SDK\Data\AuthTypes;

require_once '../vendor/autoload.php';
require_once 'config.php';

$config    = new Config($projectUri, $login, $password, $externalAppId, $authType);
$careCloud = new CareCloud($config);

try {
    // Get all point records
    $points = $careCloud->pointsApi()->getPoints();
    $items = $points->getData()->getPoints();
    $totalItems = $points->getData()->getTotalItems();

    // Get a collection of purchases by points
    $purchasesByPoints = $careCloud->pointsApi()->getSubPointPurchases('8bed991c68a470e7aaeffbf048');
    $purchasesItems = $purchasesByPoints->getData()->getPurchases();
    $purchasesTotalItems = $purchasesByPoints->getData()->getTotalItems();

} catch (ApiException $e) {
    die(var_dump($e->getResponseBody()));
}
