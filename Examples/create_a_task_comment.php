<?php
/**
 * Create a task comment
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\TaskComment;
use CrmCareCloud\Webservice\RestApi\Client\Model\TaskIdTaskcommentsBody;
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
$task_id = '8bed991c68a470e7aaeffbf048'; // string | The unique id of the task

// Set the task comment
$task_comment = new TaskComment();
$task_comment->setText('Text of the comment'); // string | Text of the comment

// Set the request body
$body = new TaskIdTaskcommentsBody();
$body->setTaskComment($task_comment);

// Call endpoint and post data
try {
    $post_comment = $care_cloud->tasksApi()->postTaskComment($body, $task_id, $accept_language);
    $task_comment_id = $post_comment->getData()->getTaskCommentId();
    var_dump($task_comment_id);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}