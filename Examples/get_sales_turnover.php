<?php
/**
 * Get sales turnover
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
$customer_id = '8ea2591121e636086a4a9c0992'; // string | The unique id of the customer
$date_from = null; // string | Start of the time interval (YYYY-MM-DD) (optional)
$date_to = null; // string | End of the time interval (YYYY-MM-DD) (optional)

// Call endpoint and get data
try {
    $get_sales_turnover = $care_cloud->walletApi()->getWalletSalesTurnover(
        $customer_id,
        $accept_language,
        $date_from,
        $date_to
    );
    $sales_turnover = $get_sales_turnover->getData()->getTurnover();
    var_dump($sales_turnover);
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}