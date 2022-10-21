<?php
/**
 * Get all customer vouchers
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
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

// Set path parameter
$customer_id = '8ea2591121e636086a4a9c0992'; // string | The unique id of the customer

// Set query parameters
$count = 1; // integer >= 1 | The number of records to return (optional, default is 100)
$offset = 0; // integer | The number of records from a collection to skip (optional, default is 0)
$sort_field = null; // string | One of the query string parameters for sorting (optional, default is null)
$sort_direction = 'DESC'; // string | Direction of sorting the response list (optional, default is null)
$code = null; // string | The unique code of the voucher (optional, default is null)
$store_id = null; // string | The unique id of the store where customer can apply the reward (optional, default is null)
$is_valid = null; // boolean | In validity range - true / before or after validity range - false / no value - all (optional, default is null)
$is_applied = null; // boolean | Filter by voucher application and reservation (optional, default is null)
$without_stores = null; // boolean | If true, the data will not contain information about business units (stores). If false, or not set resource returns default structure (optional)

// Call endpoint and get data
try
{
    $get_vouchers = $care_cloud->customersApi()->getSubCustomerVouchers(
        $customer_id,
        $accept_language,
        $count,
        $offset,
        $sort_field,
        $sort_direction,
        $code,
        $store_id,
        $is_valid,
        $is_applied,
        $without_stores
    );
    $vouchers = $get_vouchers->getData()->getVouchers();
    $total_items = $get_vouchers->getData()->getTotalItems();
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}