<?php
/**
 * Add an interest record to a customer
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\CustomerIdInterestrecordsBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\InterestRecord;
use CrmCareCloud\Webservice\RestApi\Client\SDK\CareCloud;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Config;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Data\AuthTypes;

require_once '../vendor/autoload.php';

$project_uri = 'https://yourapiurl.com/webservice/rest-api/enterprise-interface/v1.0';
$login = 'login';
$password = 'password';
$external_app_id = 'application_id';
$auth_type = AuthTypes::BEARER_AUTH;
// Or if using basic auth, just change the AuthType to Basic Auth
// $authType      = AuthTypes::BASIC_AUTH;

$config = new Config($project_uri, $login, $password, $external_app_id, $auth_type);

$care_cloud = new CareCloud($config);

// Set Header parameter Accept-Language
$accept_language = 'en'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set path parameter
$customer_id = '8ea2591121e636086a4a9c0992'; // string | The unique id of the customer

// Set interest info
$interest_record = new InterestRecord();
$interest_record->setInterestId('8bed991c68a470e7aaeffbf048'); // string | The unique id of the interest
$interest_record->setCustomerId('8ea2591121e636086a4a9c0992'); // string | The unique id of the customer

$body = new CustomerIdInterestrecordsBody();
$body->setInterestRecord($interest_record);

// Call endpoint and post data
try
{
    $post_interest = $care_cloud->customersApi()->postSubCustomerInterest($body, $customer_id, $accept_language);
    $interest_record_id = $post_interest->getData()->getInterestRecordId();
    var_dump($interest_record_id);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}