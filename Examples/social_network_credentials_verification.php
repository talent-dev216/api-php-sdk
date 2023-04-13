<?php
/**
 * Social network credentials verification
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsVerifysocialnetworkcredentialsBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\SocialNetworkCredentials;
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

// Set social network credentials
$social_network_credentials = new SocialNetworkCredentials();
$social_network_credentials->setSocialNetworkId('twitter'); // string | The unique id of the social network
$social_network_credentials->setSocialNetworkToken('e123'); // string | Social network customer's token

//Set the request body
$body = new ActionsVerifysocialnetworkcredentialsBody();
$body->setSocialNetworkCredentials($social_network_credentials);

// Call endpoint and post data
try {
    $post_credentials = $care_cloud->customersActionsApi()->postCustomerVerifySocialNetworkCredentials($body);
    $customer_id = $post_credentials->getData()->getCustomerId();
    var_dump($customer_id);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}