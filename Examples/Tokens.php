<?php

use CareCloud\ApiException;
use CareCloud\Model\Device;
use CareCloud\Model\Setup;
use CareCloud\Model\TokensBody;
use CareCloud\SDK\Config;
use CareCloud\SDK\CareCloud;
use CareCloud\SDK\Data\AuthTypes;

require_once '../vendor/autoload.php';
require_once 'config.php';

$config    = new Config($projectUri, $login, $password, $externalAppId, $authType);
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
    die(var_dump($e->getResponseBody()));
}
