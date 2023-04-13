<?php

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Config;
use CrmCareCloud\Webservice\RestApi\Client\SDK\CareCloud;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Data\AuthTypes;

require_once '../vendor/autoload.php';
require_once 'config.php';

$config = new Config($projectUri, $login, $password, $externalAppId, $authType);
$careCloud = new CareCloud($config);

try {
    // Get all reward properties
    $rewardProperties = $careCloud->rewardPropertiesApi()->getRewardProperties();
    $items = $rewardProperties->getData()->getRewardProperties();
    $totalItems = $rewardProperties->getData()->getTotalItems();
} catch (ApiException $e) {
    var_dump($e->getResponseBody());
    die();
}
