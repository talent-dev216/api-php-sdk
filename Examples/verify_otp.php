<?php
/**
 * Verify a one-time password
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsVerifyBody;
use CrmCareCloud\Webservice\RestApi\Client\SDK\CareCloud;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Config;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Data\AuthTypes;

require_once 'vendor/autoload.php';

$project_uri = 'https://yourapiurl.com/webservice/rest-api/enterprise-interface/v1.0';
$login = 'login';
$password = 'password';
$external_app_id = 'application_id';
$auth_type = AuthTypes::BEARER_AUTH;

$config = new Config($project_uri, $login, $password, $external_app_id, $auth_type);

$care_cloud = new CareCloud($config);

// Set Header parameter Accept-Language
$accept_language = 'en'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

$body = new ActionsVerifyBody();
$body->setVerificationCode('7R29') // string | Verification code from email, SMS or notification provided by recipient
->setRequestId('b223286fbc1de2db689d443be35b1f6078f059d3') // string | The parameter specifies the request that caused the OTP to be created
->setExternalApplicationId($external_app_id); // string | Id of the external application that requested one time password

// Call endpoint and post data
try
{
    $post_verify_otp = $care_cloud->oneTimePasswordApi()->postVerifyOtp($body, $accept_language);
    $is_valid = $post_verify_otp->getData()->getIsValid();
    var_dump($is_valid);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}