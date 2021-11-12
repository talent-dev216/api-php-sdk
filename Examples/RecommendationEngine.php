<?php

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\SDK\Config;
use CrmCareCloud\Webservice\RestApi\SDK\CareCloud;
use CrmCareCloud\Webservice\RestApi\SDK\Data\AuthTypes;

require_once '../vendor/autoload.php';
require_once 'config.php';

$config    = new Config($projectUri, $login, $password, $externalAppId, $authType);
$careCloud = new CareCloud($config);

try {
    // Get the best recommendation with an elimination
    $recommendationProductEliminate = $careCloud->recommendationEngineApi()->getRecommendationProductEliminate('8bed991c68a470e7aaeffbf048');
    $items = $recommendationProductEliminate->getData()->getRecommendedProductsList();
    $totalItems = $recommendationProductEliminate->getData()->getTotalItems();
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody()));
}
