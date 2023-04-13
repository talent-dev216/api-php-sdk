<?php
/**
 * Update an interest record on an account
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\InterestRecord;
use CrmCareCloud\Webservice\RestApi\Client\Model\InterestrecordsInterestRecordIdBody;
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
$interest_record_id = '8bed991c68a470e7aaeffbf048'; // string | The unique id of the interest record

// Set interest info
$interest_record = new InterestRecord();
$interest_record->setInterestId('81eaeea13b8984a169c490a325'); // string | The unique id of the interest
$interest_record->setCustomerId('8ea2591121e636086a4a9c0992'); // string | The unique id of the customer

$body = new InterestrecordsInterestRecordIdBody();
$body->setInterestRecord($interest_record);

// Call endpoint and put data
try {
    $care_cloud->customersApi()->putSubCustomerInterest($body, $customer_id, $interest_record_id, $accept_language);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}