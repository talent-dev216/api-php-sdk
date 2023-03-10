<?php
/**
 * Detail of a product reservation external list type
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
$product_reservation_external_list_type_id = '86e05affc7a7abefcd513ab400'; // string | The unique id

// Call endpoint and get data
try
{
    $get_product_reservation_ext_list_type = $care_cloud->productReservationExternalListTypesApi()->getProductReservationExternalListType(
        $product_reservation_external_list_type_id,
        $accept_language
    );
    $product_reservation_ext_list_type = $get_product_reservation_ext_list_type->getData();
    var_dump($product_reservation_ext_list_type);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}