<?php
/**
 * Get all point records
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
// Or if using basic auth, just change the AuthType to Basic Auth
// $authType      = AuthTypes::BASIC_AUTH;

$config = new Config($project_uri, $login, $password, $external_app_id, $auth_type);

$care_cloud = new CareCloud($config);

// Set Header parameter Accept-Language
$accept_language = 'en'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set query parameters
$count = 10; // integer >= 1 | The number of records to return (optional, default is 100)
$offset = 0; // integer | The number of records from a collection to skip (optional, default is 0)
$sort_field = null; // string | One of the query string parameters for sorting (optional, default is null)
$sort_direction = 'DESC'; // string | Direction of sorting the response list (optional, default is null)
$customer_id = null; // string | The unique id of the customer (optional, default is null)
$point_type_id = null; // string | The unique id of the point type (optional, default is null)
$create_point_time_from = null; // string | Date and time from of the create point record (YYYY-MM-DD HH:MM:SS) (optional, default is null)
$create_point_time_to = null; // string | Date and time to of the create point record (YYYY-MM-DD HH:MM:SS) (optional, default is null)

// Call endpoint and get data
try
{
    $get_points = $care_cloud->pointsApi()->getPoints(
        $accept_language,
        $count,
        $offset,
        $sort_field,
        $sort_direction,
        $customer_id,
        $point_type_id,
        $create_point_time_from,
        $create_point_time_to
    );
    $points = $get_points->getData()->getPoints();
    $total_items = $get_points->getData()->getTotalItems();
    var_dump($points);
    var_dump($total_items);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}