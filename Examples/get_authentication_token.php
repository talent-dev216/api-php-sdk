<?php
/**
 * Get authentication token
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
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
$token_id = '8ea02b112ccac496a3d423c5b1'; // string | Client's application token

// Set query parameters
$external_application_id = '82de12eb8b138791e678fd11c3'; // string | Id of the external application
$token_type = 1; // integer | Possible values: 1- alphanumeric, 2- numeric

// Call endpoint and get data
try
{
    $get_token = $care_cloud->tokensApi()->getTokenAuthentication(
        $token_id,
        $external_application_id,
        $token_type,
        $accept_language
    );
    $token = $get_token->getData();
    var_dump($token);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}