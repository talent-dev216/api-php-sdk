<?php
/**
 * Get all customers
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
$sort_field = 'last_change'; // string | One of the query string parameters for sorting (optional)
$sort_direction = 'DESC'; // string | Direction of sorting the response list (optional)
$email = null; // string | Search by email (optional)
$phone = null; // string | Phone number with international prefix (420000000) (optional)
$customer_source_id = null; // string | The unique id of the customer source. It identifies the system where the customer belongs or the customer account was created (optional)
$first_name = 'John'; // string | Search by first name (optional)
$last_name = null; // string | Search by last name (optional)
$birthdate = null; // string | Customer's date of birth. Possible values are: YYYY-MM-DD / DD.MM.YYYY (optional)

// Call endpoint and get data
try
{
    $get_customers = $care_cloud->customersApi()->getCustomers(
        $accept_language,
        $count,
        $offset,
        $sort_field,
        $sort_direction,
        $email,
        $phone,
        $customer_source_id,
        $first_name,
        $last_name,
        $birthdate
    );
    $customers = $get_customers->getData()->getCustomers();
    $total_items = $get_customers->getData()->getTotalItems();
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}