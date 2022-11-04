<?php
/**
 * Login via social network
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsSocialnetworkloginBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\SocialNetworkCredentials;
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

// Set social network credentials
$credentials = new SocialNetworkCredentials();
$credentials->setSocialNetworkId('twitter'); // string | The unique id of the social network
$credentials->setSocialNetworkToken('38e123j1jedu12d1jnjqwd'); // string | Social network customer's token

// Set the request body
$body = new ActionsSocialnetworkloginBody();
$body->setSocialNetworkCredentials($credentials);

// Call endpoint and post data
try
{
    $post_social_network_login = $care_cloud->tokensApi()->postTokenSocialLogin($body, $token_id, $accept_language);
    $customer_id = $post_social_network_login->getData()->getCustomerId();
    var_dump($customer_id);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}