<?php
/**
 * Send the message for the setup of a new customer's password
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsSendBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsSendpasswordsetupemailBody;
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
$token = 'BASE64_encoded_string_user_name';

$config = new Config($project_uri, $login, $password, $external_app_id, $auth_type, $interface, null, $token);

$care_cloud = new CareCloud($config);

// Set Header parameter Accept-Language
$accept_language = 'en'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set the request body
$body = new ActionsSendpasswordsetupemailBody();
$body->setCommunicationChannelId('86e05affc7a7abefcd513ab400') // string  | The unique id of the communication channel from GET /communication-channels resource
->setRecipient('happy_customer@cortex.cz'); // string | Recipient of the message

// Call endpoint and post data
try {
    $care_cloud->tokensApi()->postTokenSendPasswordSetup($body, $token, $accept_language);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}