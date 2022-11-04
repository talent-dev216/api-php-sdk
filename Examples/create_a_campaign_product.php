<?php
/**
 * Create a campaign product
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\CampaignPresentationData;
use CrmCareCloud\Webservice\RestApi\Client\Model\CampaignProduct;
use CrmCareCloud\Webservice\RestApi\Client\Model\CampaignproductsBody;
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

// Set campaign presentation data details
$presentation_data = new CampaignPresentationData();
$presentation_data->setName('Macbook Air 13" M1 10% off'); // string | Name of the product
$presentation_data->setSubtitle('Discount only in following two days'); // string | Text of the campaign product subtitle (optional)
$presentation_data->setNote('This offer is limited');  // string | Text of the campaign product note (optional)
$presentation_data->setDescription(null); // string | Text of the campaign product description (optional)
$presentation_data->setImageUrl(null); // string | URL address of the image (optional)

// Set basic information about new campaign product
$campaign_product = new CampaignProduct();
$campaign_product->setProductId('8fd73167342d06899c4c015320'); // string | The unique id for the product
$campaign_product->setCurrencyId('8bed991c68a470e7aaeffbf048'); // string | The unique id for the currency
$campaign_product->setCampaignId('82db62087b0f79a6e14e5747e7'); // string | The unique id for the campaign
$campaign_product->setValue(100); // float | Value of the product
$campaign_product->setValueTypeId(2); // int | Type of value (1 - percentage discount value, 2 - final price)
$campaign_product->setValidFrom('2022-10-17 00:00:00'); // string | Valid from (YYYY-MM-DD HH:MM:SS)
$campaign_product->setValidTo('2022-10-19 00:00:00'); // string | Valid to (YYYY-MM-DD HH:MM:SS)
$campaign_product->setDisplayIn(array()); // string[] | List of possible display places (optional)
$campaign_product->setTypeId('86e05affc7a7abefcd513ab400'); // string | Type of the campaign product
$campaign_product->setPresentationData($presentation_data);

// Set information about new campaign product to the request body
$body = new CampaignproductsBody();
$body->setCampaignProduct($campaign_product);

// Call endpoint and post data
try
{
    $new_campaign_product = $care_cloud->campaignProductsApi()->postCampaignProduct($body, $accept_language);
    $new_campaign_product_id = $new_campaign_product->getData()->getCampaignProductId();
    var_dump($new_campaign_product_id);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}