<?php

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\Device;
use CrmCareCloud\Webservice\RestApi\Client\Model\Setup;
use CrmCareCloud\Webservice\RestApi\Client\Model\TokensBody;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Config;
use CrmCareCloud\Webservice\RestApi\Client\SDK\CareCloud;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Data\AuthTypes;

require_once '../vendor/autoload.php';
require_once 'config.php';

$config = new Config($projectUri, $login, $password, $externalAppId, $authType);
$careCloud = new CareCloud($config);

try {
    // Get information about all events

    $device = new Device();
    $device->setDeviceId('123654')
        ->setDeviceSystem('OSX')
        ->setDeviceName('Test phone')
        ->setDeviceType('iPhone');

    $setup = new Setup();
    $setup->setLanguageId('en')
        ->setAllowedGps(true)
        ->setAllowedNotifications(true);

    $body = new TokensBody();
    $body->setDevice($device)->setSetup($setup);

    $createToken = $careCloud->tokensApi()->postToken($body);
    $token_id = $createToken->getData()->getTokenId();
} catch (ApiException $e) {
    var_dump($e->getResponseBody());
    die();
}
