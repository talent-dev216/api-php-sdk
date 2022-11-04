<?php
/**
 * Create a new voucher
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsCreatevoucherBody;
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

// Set path parameters
$reward_id = '8fd73167342d06899c4c015320'; // string | The unique id of the reward

// Set the request body
$body = new ActionsCreatevoucherBody();
$body->setCustomerId('8ea2591121e636086a4a9c0992'); // string | The unique id of the customer
$body->setCode('e1234'); // string | Code of the voucher (optional)
$body->setNote('test voucher 2'); // string | Note for the voucher

// Call endpoint and post data
try
{
    $post_voucher = $care_cloud->rewardsApi()->postRewardCreateVoucher(
        $body,
        $reward_id,
        $accept_language
    );
    $voucher_id = $post_voucher->getData()->getVoucherId();
    var_dump($voucher_id);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}