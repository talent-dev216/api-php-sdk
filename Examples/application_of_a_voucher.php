<?php
/**
 * Application of a voucher
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsApplyvoucherBody;
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

// Set path parameters
$voucher_id = '85d6598db0bf3f62afd5db8507'; // string | The unique id of the voucher

// Set the request body
$body = new ActionsApplyvoucherBody();
$body->setStoreId(null); // string | The unique id of the store (optional)
$body->setDateApplied('2022-10-28 15:52:00'); // string | Date (ISO 8601) of voucher application (YYYY-MM-DD HH:MM:SS)

// Call endpoint and post data
try {
    $care_cloud->vouchersApi()->postVoucherApply($body, $voucher_id, $accept_language);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}