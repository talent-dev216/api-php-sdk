<?php

use CareCloud\ApiException;
use CareCloud\Model\ActionsLoginBody1;
use CareCloud\SDK\Config;
use CareCloud\SDK\CareCloud;
use CareCloud\SDK\Data\AuthTypes;

require_once '../vendor/autoload.php';
require_once 'config.php';

$config    = new Config($projectUri, $login, $password, $externalAppId, $authType);
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
