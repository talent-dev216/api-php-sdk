<?php
/**
 * Upload customer's profile photo
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsUploadcustomerphotoBody;
use CrmCareCloud\Webservice\RestApi\Client\SDK\CareCloud;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Config;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Data\AuthTypes;

require_once '../vendor/autoload.php';

$project_uri = 'https://yourapiurl.com/webservice/rest-api/enterprise-interface/v1.0';
$login = 'login';
$password = 'password';
$external_app_id = 'application_id';
$auth_type = AuthTypes::BEARER_AUTH;

$config = new Config($project_uri, $login, $password, $external_app_id, $auth_type);

$care_cloud = new CareCloud($config);

// Set Header parameter Accept-Language
$accept_language = 'en'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set the request body
$body = new ActionsUploadcustomerphotoBody();
$body->setCustomerId('8ea2591121e636086a4a9c0992'); // string | The unique id of the customer
$body->setData('YTc4ZTExZTc3NGY3Zmh1b3dmamZram5sam5kZmpuZm5mIGRzbiBzZGpuc2Rsam5kc2Y'); // string | Base 64 encoded image data

// Call endpoint and post data
try {
    $care_cloud->customersActionsApi()->postCustomersUploadPhoto($body);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}