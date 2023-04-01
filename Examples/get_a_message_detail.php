<?php
/**
 * Get a message detail
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
$message_id = '8bd62e6ba18b3c791a9402cf3e'; // string | The unique id of the message

// Call endpoint and get data
try {
    $get_message_detail = $care_cloud->messagesApi()->getSubMessageDetail(
        $message_id,
        $accept_language
    );
    $message_detail = $get_message_detail->getData();
    var_dump($message_detail);
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}