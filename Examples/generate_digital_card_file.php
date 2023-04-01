<?php
/**
 * Generate digital card file
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsGeneratedigitalcardfileBody;
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

// Set info to the request body
$body = new ActionsGeneratedigitalcardfileBody();
$body->setCardId('8bd253a890067595008f1d44aa'); // string | Id of the card. It will generate file from this card
$body->setFileType('png'); // string | Type of the final file Possible values: png - generates picture in png format /wallet - generates pass package file for Apple Wallet

// Call endpoint and post data
try {
    $post_generate_card = $care_cloud->cardsApi()->postGenerateDigitalCard($body, $accept_language);
    $file_url = $post_generate_card->getData()->getFileUrl();
    var_dump($file_url);
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}