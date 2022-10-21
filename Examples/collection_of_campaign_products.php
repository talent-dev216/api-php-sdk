<?php
/**
 * Collection of campaign products
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
$name = null; // string | Search record by name or a part of the name (optional, default is null))
$code = null; // string | Code of the product (optional, default is null)
$display_in = null; // string | Place to display campaign product. (optional, default is null)
$type_id = null; // string[] | Type of the customer for a campaign product. (optional, default is null)
$store_id = null; // string | Parameter filters all campaign products from [store](#tag/Stores) by store id (optional, default is null)
$value_type_id = null; // integer | Type of value (1 - percentage discount value, 2 - final price) (optional, default is null)
$is_valid = null; // bool | *in validity range - true / before or after validity range - false / no value - all* (optional, default is null)
$valid_from = null; //string | Date and time from when is record already valid. *(YYYY-MM-DD HH:MM:SS)* (optional, default is null)
$valid_to = null; //string | Date and time to when is record still valid. *(YYYY-MM-DD HH:MM:SS)* (optional, default is null)

// Call endpoint and get data
try
{
    $get_campaign_products = $care_cloud->campaignProductsApi()->getCampaignProducts(
        $accept_language,
        $count,
        $offset,
        $sort_field,
        $sort_direction,
        $name,
        $code,
        $display_in,
        $type_id,
        $store_id,
        $value_type_id,
        $is_valid,
        $valid_from,
        $valid_to
    );
    $campaign_products = $get_campaign_products->getData()->getCampaignProducts();
    $total_items = $get_campaign_products->getData()->getTotalItems();
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}
