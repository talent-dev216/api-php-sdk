<?php
/**
 * Search customers
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
$first_name = 'Andrew'; // string | Search by first name (optional)
$lastname = 'Black'; // string | Search by last name (optional)
$birthdate = '1980-12-02'; // string | Customer's date of birth. Possible values are: YYYY-MM-DD / DD.MM.YYYY (optional)
$card_number = '1000000000016'; // string | Number of the customer card (optional)
$mode = 'strict'; // string | Possible values are: strict - return only 100% matching results (all path parameters are required)

// Call endpoint and get data
try
{
    $get_customers = $care_cloud->customersActionsApi()->getCustomerSearch(
        $accept_language,
        $first_name,
        $lastname,
        $birthdate,
        $card_number,
        $mode
    );
    $customers = $get_customers->getData();
    var_dump($customers);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}