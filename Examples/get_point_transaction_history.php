<?php

/**
 * Get point transaction history
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
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

// Set query parameters
$count = 10; // integer >= 1 | The number of records to return (optional, default is 100)
$offset = 10; // integer | The number of records from a collection to skip (optional, default is 0)
$sort_field = null; // string | One of the query string parameters for sorting (optional, default is null)
$sort_direction = 'DESC'; // string | Direction of sorting the response list (optional, default is null)
$customer_id = '8ea2591121e636086a4a9c0992'; // string | The unique id of the customer
$store_id = null; // string | The unique id of the store in CareCloud (optional, default is null)
$partner_id = null; // string | Unique ID of the partner from the resource GET /partners (optional, default is null)
$time_from = null; // string | Filter results on the start of the time interval, YYYY-MM-DD HH:MM:SS (optional, default is null)
$time_to = null; // string | Filter results on the end of the time interval, YYYY-MM-DD HH:MM:SS (optional, default is null)
$point_operation_type = null; // string | Search record by the operation type name or a part of the operation type name (optional, default is null)
$point_operation_note = null; // string | Search record by the operation note or a part of the operation note (optional, default is null)
$point_type_id = null; // string | The unique id of a point type (optional, default is null)

// Call endpoint and get data
try {
    $get_point_history = $care_cloud->pointHistoryApi()->getPointHistory(
        $customer_id,
        $accept_language,
        $count,
        $offset,
        $sort_field,
        $sort_direction,
        $store_id,
        $partner_id,
        $time_from,
        $time_to,
        $point_operation_type,
        $point_operation_note,
        $point_type_id
    );
    $point_history = $get_point_history->getData()->getPointHistory();
    $total_items = $get_point_history->getData()->getTotalItems();
    var_dump($point_history);
    var_dump($total_items);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}