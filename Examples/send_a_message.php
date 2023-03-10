<?php
/**
 * Send a message
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsSendmessageBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\Message;
use CrmCareCloud\Webservice\RestApi\Client\Model\Parameter;
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
$parameter = new Parameter();
$parameter->setParameterName('parameter_name');
$parameter->setValue('parameter_value');

$message = new Message();
$message->setCustomerId('8ea2591121e636086a4a9c0992'); // string | The unique id of the customer
$message->setMessageTemplateId('8bed991c68a470e7aaeffbf048'); // string | The unique id of the message template
$message->setContact('happycustomer@crmcarecloud.com'); // string | Email address or phone number of customer in case of send message to different contact than customer has in database (optional)
$message->setCommunicationChannelId(1); // integer | 1 - email / 2- SMS / 4 - PUSH notification (Apple or Google)/ 5 - internal system notification
$message->setMessageData(array($parameter));

$body = new ActionsSendmessageBody();
$body->setMessage($message);

// Call endpoint and post data
try
{
    $care_cloud->messagesApi()->postMessageSend(
        $body,
        $accept_language
    );
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}