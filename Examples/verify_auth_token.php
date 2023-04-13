<?php
/**
 * Verify auth token
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsVerifyauthtokenBody;
use CrmCareCloud\Webservice\RestApi\Client\SDK\CareCloud;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Config;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Data\AuthTypes;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Data\Interfaces;

require_once '../vendor/autoload.php';

$project_uri = 'https://yourapiurl.com/webservice/rest-api/enterprise-interface/v1.0';
$login = 'login';
$password = 'password';
$external_app_id = 'application_id';
$auth_type = AuthTypes::BEARER_AUTH;
$interface = Interfaces::CUSTOMER;
$token = 'token';

$config = new Config($project_uri, $login, $password, $external_app_id, $auth_type, $interface, null, $token);

$care_cloud = new CareCloud($config);

// Set Header parameter Accept-Language
$accept_language = 'en'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set path parameters
$token_id = '702baa4a40a57694831321e5d02605d46c189369126ae43a81030790ea188af87e49578a'; // Client's application token

// Set query parameters
$external_application_id = '82de12eb8b138791e678fd11c3'; // string | Id of the external application
$token_type = 1; // integer | Possible values: 1 - alphanumeric, 2 - numeric

// Set the request body
$body = new ActionsVerifyauthtokenBody();
$body->setApplicationId($external_application_id);
$body->setToken('V952TL');
$body->setTokenRequestId('326a3adc83f925a27cb8c0318d9bbceeb00f65e4');

// Call endpoint and post data
try {
    $post_verify_token = $care_cloud->customersActionsApi()->postCustomersVerifyAuthToken($body);
    $customer_id = $post_verify_token->getData()->getCustomerId();
    var_dump($customer_id);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}