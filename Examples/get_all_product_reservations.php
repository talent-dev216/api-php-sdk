<?php

/**
 * Get all product reservations
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
$customer_id = null; // string | The unique id of the customer (optional)
$store_id = null; // string | The unique id of the store (optional)
$reservation_state = null; // integer | Possible values: 0 - Canceled / 1 - Entered / 2 - Accepted / 3 - Ready / 4 - Delivered / 5 - In progress / 6 - Not Picked up / 7 - Ordered / 8 - Being solved / (optional)
$external_reservation_list_type_id = null; // string | If set, external_reservation_code has to be present in request too (optional)
$external_reservation_code = null; // string |  If set, external_reservation_list_type_id has to be present in request too (optional)

// Call endpoint and get data
try {
    $get_product_reservations = $care_cloud->productReservationsApi()->getProductReservations(
        $accept_language,
        $count,
        $offset,
        $sort_field,
        $sort_direction,
        $customer_id,
        $store_id,
        $reservation_state,
        $external_reservation_list_type_id,
        $external_reservation_code
    );
    $product_reservations = $get_product_reservations->getData()->getProductReservations();
    $total_items = $get_product_reservations->getData()->getTotalItems();
    var_dump($product_reservations);
    var_dump($total_items);
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}