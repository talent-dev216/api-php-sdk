<?php
/**
 * Create a reservation
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

// Set the request body
$external_code1 = new \CrmCareCloud\Webservice\RestApi\Client\Model\ExternalCode();
$external_code1->setExternalCodeTypeId(1); // integer | The unique id of the external code type
$external_code1->setValue('ext_code_001'); // string | Value of the external code

$product_reservation = new \CrmCareCloud\Webservice\RestApi\Client\Model\ProductReservation();
$product_reservation->setCustomerId('8ea2591121e636086a4a9c0992');
$product_reservation->setStoreId('8bed991c68a470e7aaeffbf048');
$product_reservation->setExternalReservationCodes(array($external_code1));
$product_reservation->setProductReservationSourceId('86e05affc7a7abefcd513ab400');

$body = new \CrmCareCloud\Webservice\RestApi\Client\Model\ProductreservationsBody();
$body->setProductReservation($product_reservation);

// Call endpoint and post data
try {
    $post_product_reservation = $care_cloud->productReservationsApi()->postProductReservation(
        $body,
        $accept_language
    );
    $product_reservation_id = $post_product_reservation->getData()->getProductReservationId();
    var_dump($product_reservation_id);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}