<?php
/**
 * Create a token
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\Device;
use CrmCareCloud\Webservice\RestApi\Client\Model\Setup;
use CrmCareCloud\Webservice\RestApi\Client\Model\TokensBody;
use CrmCareCloud\Webservice\RestApi\Client\SDK\CareCloud;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Config;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Data\AuthTypes;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Data\Interfaces;

require_once '../vendor/autoload.php';

$project_uri = 'https://yourapiurl.com/webservice/rest-api/customer-interface/v1.0';
$login = 'login';
$password = 'password';
$external_app_id = 'application_id';
$auth_type = AuthTypes::BASIC_AUTH;
$interface = Interfaces::CUSTOMER;
$token = 'BASE64_encoded_string_user_name';

$config = new Config($project_uri, $login, $password, $external_app_id, $auth_type);

$care_cloud = new CareCloud($config);

// Set Header parameter Accept-Language
$accept_language = 'en'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set the device info
$device = new Device();
$device->setDeviceId('test121212'); // string | The unique id of the client device
$device->setDeviceSystem('iOS'); // string | Operation system of the device
$device->setDeviceName('Apple iPhone'); // string | The name of the device
$device->setDeviceType('test_device'); // string | Type of device by producer (product line)

// Set the setup info
$setup = new Setup();
$setup->setLanguageId('en'); // string | The unique id of the language by ISO 639-1 code from languages resource
$setup->setAllowedGps(false); // boolean | Permission to GPS tracking in the mobile application
$setup->setAllowedNotifications(false); // boolean | Permission to the mobile application's notifications

// Set the request body
$body = new TokensBody();
$body->setDevice($device);
$body->setSetup($setup);
$body->setExternalApplicationId('82de12eb8b138791e678fd11c3'); // string | Id of the customer-external-application resource
$body->setPushToken(''); // string | Push notification token (Apple or Google) (optional)

// Call endpoint and post data
try {
    $post_token = $care_cloud->tokensApi()->postToken($body, $accept_language);
    $token_id = $post_token->getData()->getTokenId();
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}