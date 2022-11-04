<?php
/**
 * Customer credentials verification
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsVerifycredentialsBody;
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

//Set the request body
$body = new ActionsVerifycredentialsBody();
$body->setLoginType('email'); // string | The unique id of the login type (available: card, email)
$body->setLoginValue('customer_email@example.com'); // string | Value of the login for customer interface API
$body->setPassword('customer_password'); // string | Password of the customer.

// Call endpoint and post data
try
{
    $post_credentials = $care_cloud->customersActionsApi()->postCustomerVerifyCredentials($body);
    $customer_id = $post_credentials->getData()->getCustomerId();
    var_dump($customer_id);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}