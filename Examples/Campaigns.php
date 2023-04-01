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
    // Collection of campaigns
    $campaigns = $careCloud->campaignsApi()->getCampaigns();
    $items = $campaigns->getData()->getCampaigns();
    $totalItems = $campaigns->getData()->getTotalItems();
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody()));
}
