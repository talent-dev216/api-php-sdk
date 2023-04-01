<?php

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsLoginBody1;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Config;
use CrmCareCloud\Webservice\RestApi\Client\SDK\CareCloud;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Data\AuthTypes;

require_once '../vendor/autoload.php';
require_once 'config.php';

$config = new Config($projectUri, $login, $password, $externalAppId, $authType);
$careCloud = new CareCloud($config);

try {
    // User login
    $body = new ActionsLoginBody1();
    $body->setUserExternalApplicationId('4d9495b4e723e7a')
        ->setLogin('example@crmcarecloud.com')
        ->setPassword('password_example');

    $user = $careCloud->usersApi()->postUserLogin($body);
    $token = $user->getData()->getBearerToken();
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody()));
}
