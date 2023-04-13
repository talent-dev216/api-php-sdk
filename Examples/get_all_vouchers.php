<?php
/**
 * Get all vouchers
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

$config = new Config($project_uri, $login, $password, $external_app_id, $auth_type);

$care_cloud = new CareCloud($config);

// Set Header parameter Accept-Language
$accept_language = 'en'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set query parameters
$count = 10; // integer >= 1 | The number of records to return (optional, default is 100)
$offset = 0; // integer | The number of records from a collection to skip (optional, default is 0)
$sort_field = null; // string | One of the query string parameters for sorting (optional, default is null)
$sort_direction = 'DESC'; // string | Direction of sorting the response list (optional, default is null)
$customer_id = null; // string | The unique id of the customer (optional, default is null)
$code = null; // string | The code of the reward (optional, default is null)
$store_id = null; // string | The unique id of the store where customer can apply the reward (optional, default is null)
$is_valid = null; // boolean | In validity range - true / before or after validity range - false / no value - all (optional, default is null)
$is_applied = null; // boolean | Filter by voucher application and reservation (optional)
$without_stores = null; // boolean | If true, the data will not contain information about business units (stores). If false, or not set resource returns default structure (optional)

// Call endpoint and get data
try {
    $get_vouchers = $care_cloud->vouchersApi()->getVouchers(
        $accept_language,
        $count,
        $offset,
        $sort_field,
        $sort_direction,
        $customer_id,
        $code,
        $store_id,
        $is_valid,
        $is_applied,
        $without_stores
    );
    $vouchers = $get_vouchers->getData()->getVouchers();
    $total_items = $get_vouchers->getData()->getTotalItems();
    var_dump($vouchers);
    var_dump($total_items);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}