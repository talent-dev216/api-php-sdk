<?php
/**
 * Add a partner to the customer
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\CustomerIdPartnerrecordsBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\PartnerRecord;
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
$customer_id = '8fa66731256448d1ae0c19a1dd'; // string | The unique id of the customer

// Set the request body
$partner_record = new PartnerRecord();
$partner_record->setPartnerId('86e05affc7a7abefcd513ab400'); // string | The unique id of the partner

$body = new CustomerIdPartnerrecordsBody();
$body->setPartnerRecord($partner_record);

// Call endpoint and post data
try {
    $post_customer_partner = $care_cloud->customersApi()->postSubCustomerPartnerRecord(
        $body,
        $customer_id,
        $accept_language
    );
    $partner_record_id = $post_customer_partner->getData()->getPartnerRecordId();
    var_dump($partner_record_id);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}