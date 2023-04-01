<?php
/**
 * Assign customer
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsAssigncustomerBody;
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
$body = new ActionsAssigncustomerBody();
$body->setStoreId('8fd73167342d06899c4c015320'); // string | The unique id of the store
$body->setExternalPurchaseId('123'); // string | The unique external id of the purchase
$body->setCardNumber(null); // string | Number of the customer's card. Parameter is mandatory only if customer_id is not set
$body->setCustomerId('8ea02b112ccac496a3d423c5b1'); // string | Number of the customer's card. The unique id of the customer. Parameter is mandatory only if card_number is not set

// Call endpoint and post data
try {
    $care_cloud->purchasesApi()->postPurchaseAssignCustomer($body, $accept_language);
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}