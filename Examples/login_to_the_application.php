<?php
/**
 * !Login to the application
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsLoginBody;
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

$config = new Config($project_uri, $login, $password, $external_app_id, $auth_type, $interface, null, $token);

$care_cloud = new CareCloud($config);

// Set Header parameter Accept-Language
$accept_language = 'en'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set path parameters
$token_id = '702baa4a40a57694831321e5d02605d46c189369126ae43a81030790ea188af87e49578a'; // Client's application token

// Set the request body
$body = new ActionsLoginBody();
$body->setLoginType('email'); // string | The unique id for the login type ('card' or 'email' only)
$body->setLoginValue('happy_customer@example.com'); // string | Value of the login to Customer interface API
$body->setPassword('secret_password'); // string | Customer's password

// Call endpoint and post data
try {
    $post_token_login = $care_cloud->tokensApi()->postTokenLogin($body, $token_id, $accept_language);
    $customer_id = $post_token_login->getData()->getCustomerId();
    var_dump($customer_id);
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}