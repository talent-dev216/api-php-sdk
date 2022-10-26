<?php
/**
 * Create a batch of product brands
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ProductBrand;
use CrmCareCloud\Webservice\RestApi\Client\Model\ProductbrandsBatchBody;
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

// Set product brand info
$product_brand = new ProductBrand();
$product_brand->setName('Test brand'); // string | The name of the product brand
$product_brand->setExternalId('123'); // string | The unique external id of the product brand

// Set the request body
$body = new ProductbrandsBatchBody();
$body->setProductBrands(array($product_brand));

// Call endpoint and post data
try
{
    $care_cloud->productBrandsApi()->postBulkProductBrands($body, $accept_language);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}