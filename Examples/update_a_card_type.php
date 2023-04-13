<?php
/**
 * Update a card type
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\CardType;
use CrmCareCloud\Webservice\RestApi\Client\Model\CardtypesCardTypeIdBody;
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

// Set path parameter
$card_type_id = '8bed991c68a470e7aaeffbf048'; // string | The unique id of the card type

// Set card type data
$card_type = new CardType();
$card_type->setName('Virtual card 11'); // string | Name of the card type
$card_type->setPrefix('11'); // string | Prefix of the specific card type cards

// Set data to the request body
$body = new CardtypesCardTypeIdBody();
$body->setCardType($card_type);

// Call endpoint and put data
try {
    $care_cloud->cardTypesApi()->putCardType($body, $card_type_id, $accept_language);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}