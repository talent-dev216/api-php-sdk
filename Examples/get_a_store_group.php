<?php
/**
 * Get a store group
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

// Set Header parameter Accept-Language
$accept_language = 'en'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set path parameters
$store_group_id = '8fd73167342d06899c4c015320'; // string | The unique id of the store group

// Call endpoint and get data
try
{
    $get_store_group = $care_cloud->storeGroupsApi()->getStoreGroup($store_group_id, $accept_language);
    $store_group = $get_store_group->getData();
    var_dump($store_group);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}