<?php

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Config;
use CrmCareCloud\Webservice\RestApi\Client\SDK\CareCloud;

require_once '../vendor/autoload.php';
require_once 'config.php';

$config = new Config($projectUri, $login, $password, $externalAppId, $authType);
$careCloud = new CareCloud($config);

try {
    // Get the best recommendation with an elimination
    $recommendationProductEliminateBody = new CrmCareCloud\Webservice\RestApi\Client\Model\ActionsEliminateBody();
    $recommendationProductEliminateBody->setCustomerId('8bed991c68a470e7aaeffbf048');
    $recommendationProductEliminate = $careCloud->productRecommendationEngineApi()->postRecommendationProductEliminate($recommendationProductEliminateBody);
    $items = $recommendationProductEliminate->getData()->getRecommendedProductsList();
    $totalItems = $recommendationProductEliminate->getData()->getTotalItems();
} catch (ApiException $e) {
    var_dump($e->getResponseBody());
    die();
}
