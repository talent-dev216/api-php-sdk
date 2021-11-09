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
    // Get information about all events
    $messages = $careCloud->messagesApi()->getMessages();
    $items = $messages->getData()->getMessages();
    $totalItems = $messages->getData()->getTotalItems();
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody()));
}
