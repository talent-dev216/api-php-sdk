<?php
/**
 * Detail of a customer relation type
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
$customer_relation_type_id = '8bd48117006496e0b1788109b8'; // string | The unique id of the customer relation type

// Call endpoint and get data
try {
    $get_customer_relation_type = $care_cloud->customerRelationTypesApi()->getCustomerRelationType($customer_relation_type_id, $accept_language);
    $customer_relation_type = $get_customer_relation_type->getData();
    var_dump($customer_relation_type);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}