<?php
/**
 * User login
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsLoginBody1;
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
$body = new ActionsLoginBody1();
$body->setUserExternalApplicationId('external_id'); // string | Id of an external application where user wants to be logged in
$body->setLogin('user_login'); // string | Login name of the user
$body->setPassword('user_password'); // string | User's password

// Call endpoint and post data
try {
    $post_login = $care_cloud->usersApi()->postUserLogin($body, $accept_language);
    $login_data = $post_login->getData();
    var_dump($login_data);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}