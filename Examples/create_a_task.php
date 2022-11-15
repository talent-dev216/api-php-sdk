<?php
/**
 * Update a task
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\Task;
use CrmCareCloud\Webservice\RestApi\Client\Model\TasksBody;
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

// Set the task info
$task = new Task();
$task->setTaskTypeId('8bed991c68a470e7aaeffbf048') // string | The unique id of the task type
->setTaskStateId('86e05affc7a7abefcd513ab400') // string | The unique id of the task state
->setCustomerId('85aae99524edceec17682e01b9') // string | The unique id of the customer
->setTaskNote(null) // string | Text note of the task (optional)
->setTaskTitle('Test task n.1') // string | Title of the task
->setTaskPriority(3) // integer | The parameter filters tasks by their priority. Possible values are: 1 - Critical / 2 - Major / 3 - Normal / 4 - Minor.
->setDueDate(null); // string | Due date of the task (YYYY-MM-DD) (optional)

// Set the request body
$body = new TasksBody();
$body->setTask($task);
$body->setAssignees(null); // array of objects | List of an task assignees (optional)
$body->setPropertyRecords(null); // array of objects | List of an task property records (optional)

// Call endpoint and post data
try
{
    $post_task = $care_cloud->tasksApi()->postTasks($body, $accept_language);
    $task_id = $post_task->getData()->getTaskId();
    var_dump($task_id);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}