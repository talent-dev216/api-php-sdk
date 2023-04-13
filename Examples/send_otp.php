<?php
/**
 * Send a one-time password to a communication channel
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsSendBody;
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
$body = new ActionsSendBody();
$body->setExternalApplicationId($external_app_id) // string | Id of the external application that requested one time password
->setCommunicationChannelId(1) // integer | The unique id of the communication channel. Possible values are: 1 - email / 2- SMS / 4 - PUSH notification (Apple or Google)/ 5 - internal system notification
->setRecipient('happy_customer@cortex.cz') // string | Recipient of the message with OTP. The parameter could contain email, phone number or other identifier of the message recipient
->setOtpType(1) // integer | Parameter sets witch OTP type should be generated. Possible values: 1- alphanumeric, 2- numeric (optional)
->setMessageTemplateId(null); // string | The unique id of the message_template. If not set, CareCloud uses default value from the system configuration (optional)

// Call endpoint and post data
try {
    $post_otp = $care_cloud->oneTimePasswordApi()->postSendOtp($body, $accept_language);
    $request_id = $post_otp->getData()->getRequestId();
    var_dump($request_id);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}