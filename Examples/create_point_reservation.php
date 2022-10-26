<?php
/**
 * Create point reservation
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsReservepointsBody;
use CrmCareCloud\Webservice\RestApi\Client\SDK\CareCloud;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Config;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Data\AuthTypes;

require_once '../vendor/autoload.php';

$project_uri = 'https://yourapiurl.com/webservice/rest-api/enterprise-interface/v1.0';
$login = 'login';
$password = 'password';
$external_app_id = 'application_id';
$auth_type = AuthTypes::BEARER_AUTH;
// Or if using basic auth, just change the AuthType to Basic Auth
// $authType      = AuthTypes::BASIC_AUTH;

$config = new Config($project_uri, $login, $password, $external_app_id, $auth_type);

$care_cloud = new CareCloud($config);

// Set Header parameter Accept-Language
$accept_language = 'en'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set the request body
$body = new ActionsReservepointsBody();
$body->setExternalId('e134'); // string | The external unique id of the product brand
$body->setCustomerId('8ea2591121e636086a4a9c0992'); // string | The unique id of the customer
$body->setAmount(100); // float | The number of the reserved points
$body->setExpirationTime(null); // string | Date and time of the point reservation expiration (YYYY-MM-DD HH:MM:SS) (optional)

// Call endpoint and post data
try
{
    $care_cloud->pointReservationsApi()->postPointReservationCreate($body, $accept_language);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}