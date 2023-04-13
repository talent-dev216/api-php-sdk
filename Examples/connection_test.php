<?php
/**
 * Connection test
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
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

// Set query parameters
$test_string = 'taco cat'; // string | Test string send to REST API. Correct result should return a reverted string

// Call endpoint and get data
try {
    $get_connection_test = $get_connection_test = $care_cloud->testsApi()->getTestsConnection($test_string);
    $test_string_reverted = $get_connection_test->getData()->getTestString();
    var_dump($test_string_reverted);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}