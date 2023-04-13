<?php
/**
 * Cancel a reservation
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

// Set path parameters
$product_reservation_id = '81eaeea13b8984a169c490a325'; // string | The unique id of the product reservation

// Set the request body
$body = new \CrmCareCloud\Webservice\RestApi\Client\Model\ActionsCancelreservationBody();
$body->setProductReservationId($product_reservation_id);

// Call endpoint and delete data
try {
    $care_cloud->productReservationsApi()->postProductReservationCancel(
        $body,
        $product_reservation_id,
        $accept_language
    );
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}