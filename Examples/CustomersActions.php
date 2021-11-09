<?php

use CareCloud\ApiException;
use CareCloud\Model\ActionsVerifycredentialsBody;
use CareCloud\SDK\Config;
use CareCloud\SDK\CareCloud;
use CareCloud\SDK\Data\AuthTypes;

require_once '../vendor/autoload.php';
require_once 'config.php';

$config    = new Config($projectUri, $login, $password, $externalAppId, $authType);
$careCloud = new CareCloud($config);

try {
    // Customer credentials verification
    $body = new ActionsVerifycredentialsBody();
    $body->setLoginType('email')
    ->setLoginValue('happy_customer@crmcarecloud.com')
    ->setPassword('Pass123456');

    $customerSources = $careCloud->customersActionsApi()->postCustomerVerifyCredentials($body);
    $customer_id = $customerSources->getData()->getCustomerId();
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody()));
}
