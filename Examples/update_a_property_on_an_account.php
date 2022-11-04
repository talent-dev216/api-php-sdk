<?php
/**
 * Update a property on an account
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\PropertyRecord;
use CrmCareCloud\Webservice\RestApi\Client\Model\PropertyrecordsPropertyRecordIdBody;
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

// Set path parameter
$customer_id = '8ea2591121e636086a4a9c0992'; // string | The unique id of the customer
$property_record_id = 'blokace_darce:8ea2591121e636086a4a9c0992'; // string | The unique id of the property record

// Set property record info
$property_record = new PropertyRecord();
$property_record->setPropertyId('blokace_darce'); // string | The unique id of the property
$property_record->setPropertyValue(false); // mixed | Value of the property (optional) (string or null) or (number or null) or (integer or null) or (boolean or null) or (Array of any or null) or (object or null)

// Set property record info to the request body
$body = new PropertyrecordsPropertyRecordIdBody();
$body->setPropertyRecord($property_record);

// Call endpoint and put data
try
{
    $care_cloud->customersApi()->putSubCustomerProperty($body, $customer_id, $property_record_id, $accept_language);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}