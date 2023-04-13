<?php
/**
 * Create a batch of product groups
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ProductGroup;
use CrmCareCloud\Webservice\RestApi\Client\Model\ProductgroupsBatchBody;
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

// Set product group info
$product_group = new ProductGroup();
$product_group->setName('Test group'); // string | Name of the product group
$product_group->setExternalId('12'); // string | The external unique id of the product group
$product_group->setParentProductGroupId(null); // string | The unique id for the parent product group (optional)
$product_group->setParentExternalId(null); // string | The unique external id for the parent product group (optional)
$product_group->setCode(null); // string | The code of the product group (optional)
$product_group->setStoreId(null); // string | The unique id for the store where the product group is valid (optional)

// Set the request body
$body = new ProductgroupsBatchBody();
$body->setProductGroups(array($product_group));

// Call endpoint and post data
try {
    $care_cloud->productGroupsApi()->postBulkProductGroups($body, $accept_language);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}