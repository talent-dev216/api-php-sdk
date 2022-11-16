<?php
/**
 * Create a customer relation
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\CustomerIdRelatedcustomersBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\RelatedCustomer;
use CrmCareCloud\Webservice\RestApi\Client\SDK\CareCloud;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Config;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Data\AuthTypes;

require_once 'vendor/autoload.php';

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
$customer_id = '8ea2591121e636086a4a9c0992'; // string | The unique id of the customer

// Set related customer
$related_customer = new RelatedCustomer();
$related_customer->setRelatedCustomerId('8ba7d0212d8f90492c7a6d59ad'); // string | The unique id of the related customer
$related_customer->setCustomerRelationTypeId('8bed991c68a470e7aaeffbf048'); // string | The unique id of the customer relation type
$related_customer->setIsLeading(false); // boolean | Parameter says, if related customer is a leader in their relationship

// Set info to the request body
$body = new CustomerIdRelatedcustomersBody();
$body->setRelatedCustomer($related_customer);

// Call endpoint and post data
try
{
    $post_related_customer = $care_cloud->customersApi()->postSubCustomerRelatedCustomers($body, $customer_id, $accept_language);
    $customer_relation_id = $post_related_customer->getData()->getCustomerRelationId();
    var_dump($customer_relation_id);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}