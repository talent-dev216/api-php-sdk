<?php

/**
 * Create a task assignee
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\TaskAssignee;
use CrmCareCloud\Webservice\RestApi\Client\Model\TaskIdAssigneesBody;
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
$task_id = '8bed991c68a470e7aaeffbf048'; // string | The unique id of the task

// Set the task assignee info
$task_assignee = new TaskAssignee();
$task_assignee->setUserId('8a84da45ed2c825a741a321d50'); // string | The unique id of the assigned user

// Set the request body
$body = new TaskIdAssigneesBody();
$body->setTaskAssignee($task_assignee);

// Call endpoint and post data
try
{
    $post_assignee = $care_cloud->tasksApi()->postTaskAssignee($body, $task_id, $accept_language);
    $task_assignee_id = $post_assignee->getData()->getTaskAssigneeId();
    var_dump($task_assignee_id);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}