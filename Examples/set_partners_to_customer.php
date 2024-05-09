<?php
/**
 * Set one or multiple partners to the customer
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsSetpartnersBody;
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

// Set the request body
$partner_record1 = new PartnerRecord();
$partner_record1->setPartnerId('86e05affc7a7abefcd513ab400'); // string | The unique id of the partner

$body = new ActionsSetpartnersBody();
$body->setCustomerId('8ea2591121e636086a4a9c0992'); // string | The unique id of the customer
$body->setPartnerRecords([$partner_record1]);

// Call endpoint and post data
try {
    $care_cloud->customersActionsApi()->postSubCustomerSetPartners(
        $body,
        $accept_language
    );
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}