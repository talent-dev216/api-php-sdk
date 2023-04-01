<?php

/**
 * Get all tasks
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

// Set query parameters
$count = 10; // integer >= 1 | The number of records to return (optional, default is 100)
$offset = 0; // integer | The number of records from a collection to skip (optional, default is 0)
$sort_field = null; // string | One of the query string parameters for sorting (optional, default is null)
$sort_direction = 'DESC'; // string | Direction of sorting the response list (optional, default is null)
$task_type_id = null; // string | Task type id from the resource task-types. The parameter filters tasks by their type (optional)
$task_state_id = null; // string | Task state id from the resource task-states. The parameter filters tasks by their state (optional)
$customer_id = null; // string | The unique id of the customer (optional)
$priority = 3; // integer | The parameter filters tasks by their priority. Possible values are: 1 - Critical / 2 - Major / 3 - Normal / 4 - Minor (optional)
$due_date = null; // string | Date (ISO 8601) when the task due (YYYY-MM-DD) (optional)
$task_title = null; // string | Search record by the task summary or a part of the task summary (optional)
$task_note = null; // string | Search record by the task note or a part of the task note (optional)

// Call endpoint and get data
try {
    $get_tasks = $care_cloud->tasksApi()->getTasks(
        $accept_language,
        $count,
        $offset,
        $sort_field,
        $sort_direction,
        $task_type_id,
        $task_state_id,
        $customer_id,
        $priority,
        $due_date,
        $task_title,
        $task_note
    );
    $tasks = $get_tasks->getData()->getTasks();
    $total_items = $get_tasks->getData()->getTotalItems();
    var_dump($tasks);
    var_dump($total_items);
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}