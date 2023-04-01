<?php
/**
 * Update a property record of the store
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\PropertyRecord;
use CrmCareCloud\Webservice\RestApi\Client\Model\PropertyrecordsPropertyRecordIdBody1;
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
$store_id = '8bed991c68a470e7aaeffbf048'; // string | The unique id of the store
$property_record_id = 'datum_otevreni:8bed991c68a470e7aaeffbf048'; // string | The unique id of the property record

// Set property record info
$property_record = new PropertyRecord();
$property_record->setPropertyId('datum_otevreni'); // string | The unique id of the property
$property_record->setPropertyValue('2022-10-30'); // (string or null) or (number or null) or (integer or null) or (boolean or null) or (Array of any or null) or (object or null) | Value of the property (optional)

// Set the request body
$body = new PropertyrecordsPropertyRecordIdBody1();
$body->setPropertyRecord($property_record);

// Call endpoint and put data
try {
    $care_cloud->storesApi()->putSubStoreProperty($body, $store_id, $property_record_id, $accept_language);
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}