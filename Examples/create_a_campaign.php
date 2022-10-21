<?php
/**
 * Create a campaign
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\Campaign;
use CrmCareCloud\Webservice\RestApi\Client\Model\CampaignsBody;
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

// Set campaign details
$external_id = null; // string | The external id of the campaign (optional, default is null)
$parent_id = null; // string | Id of the parent campaign (optional, default is null)
$name = 'New campaign name'; // string | Name of the campaign

$campaign = new Campaign();
$campaign->setExternalId($external_id);
$campaign->setParentId($parent_id);
$campaign->setName($name);

// Set information about the new campaign
$body = new CampaignsBody();
$body->setCampaign($campaign);

// Call endpoint and post data
try
{
    $new_campaign = $care_cloud->campaignsApi()->postCampaign($body, $accept_language);
    $campaign_id = $new_campaign->getData()->getCampaignId();
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}
