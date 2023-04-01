<?php
/**
 * Get an additional customer address
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
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

// Set path parameter
$customer_id = '8ea2591121e636086a4a9c0992'; // string | The unique id of the customer
$additional_customer_address_id_path = '86e05affc7a7abefcd513ab400'; // string | Unique ID of the customer additional address

// Call endpoint and get data
try {
    $get_address = $care_cloud->customersApi()->getSubCustomerAddress($customer_id, $additional_customer_address_id_path, $accept_language);
    $address = $get_address->getData();
    var_dump($address);
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}