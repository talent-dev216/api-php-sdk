<?php

use CareCloud\ApiException;
use CareCloud\SDK\CareCloud;
use CareCloud\SDK\Config;

require_once '../vendor/autoload.php';
require_once 'config.php';

$config    = new Config($projectUri, $login, $password, $externalAppId, $authType);

$careCloud = new CareCloud($config);
try {
    $result = $careCloud->authenticate();
} catch (ApiException $e) {
    die(var_dump($e->getMessage()));
}