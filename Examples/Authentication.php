<?php

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\SDK\CareCloud;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Config;

require_once '../vendor/autoload.php';
require_once 'config.php';

$config    = new Config($projectUri, $login, $password, $externalAppId, $authType);

$careCloud = new CareCloud($config);
try {
    $result = $careCloud->authenticate();
} catch (ApiException $e) {
    die(var_dump($e->getMessage()));
}