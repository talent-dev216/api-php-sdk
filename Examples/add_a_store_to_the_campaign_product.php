<?php
/**
 * Add a store to the campaign product
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\CampaignProductIdCampaignproductstorerecordsBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\CampaignProductStoreRecord;
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

// Set path parameter
$campaign_product_id = '81eaeea13b8984a169c490a325'; // string | The unique id of the campaign product

// Set campaign product's store record data
$campaign_product_store_record = new CampaignProductStoreRecord();
$campaign_product_store_record->setStoreId('82de12eb8b138791e678fd11c3'); // string | The unique id of the store
$campaign_product_store_record->setCampaignProductId($campaign_product_id); // string | The unique id of the campaign product

// Set information about store record to the request body
$body = new CampaignProductIdCampaignproductstorerecordsBody();
$body->setCampaignProductStoreRecord($campaign_product_store_record);

// Call endpoint and post data
try
{
    $new_campaign_product_store_record = $care_cloud->campaignProductsApi()->postCampaignProductStoreRecord($body, $campaign_product_id, $accept_language);
    $campaign_product_store_record_id = $new_campaign_product_store_record->getData()->getCampaignProductStoreRecordId();
    var_dump($campaign_product_store_record_id);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}