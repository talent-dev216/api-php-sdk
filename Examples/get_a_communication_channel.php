<?php
/**
 * Get a communication channel
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
$communication_channel_id = '86e05affc7a7abefcd513ab400'; // string | The unique id of the communication channel

// Call endpoint and get data
try
{
    $get_communication_channel = $care_cloud->communicationChannelsApi()->getCommunicationChannel(
        $communication_channel_id,
        $accept_language
    );
    $communication_channel = $get_communication_channel->getData();
    //$total_items = $get_communication_channel->getData()->getTotalItems();
    var_dump($communication_channel);
    //var_dump($total_items);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}