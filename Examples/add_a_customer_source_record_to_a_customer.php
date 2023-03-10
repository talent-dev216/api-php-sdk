<?php
/**
 * Add a customer source record to a customer
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\CustomerIdCustomersourcerecordsBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\CustomerSourceRecord;
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

// Set customer source info
$customer_source_record = new CustomerSourceRecord();
$customer_source_record->setCustomerSourceId('8fdd651ff3f615bcebebad87ce'); // string | The unique external id of the customer source
$customer_source_record->setExternalId(null); // string | The unique external id of the customer (optional)

// Set info to the request body
$body = new CustomerIdCustomersourcerecordsBody();
$body->setCustomerSourceRecord($customer_source_record);

// Call endpoint and post data
try
{
    $post_source_record = $care_cloud->customersApi()->postSubCustomerSource($body, $customer_id, $accept_language);
    $source_record_id = $post_source_record->getData()->getCustomerSourceRecordId();
    var_dump($source_record_id);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}