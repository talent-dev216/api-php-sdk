<?php

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsVerifycredentialsBody;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Config;
use CrmCareCloud\Webservice\RestApi\Client\SDK\CareCloud;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Data\AuthTypes;

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
