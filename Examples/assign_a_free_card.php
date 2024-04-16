<?php
/**
 * Assign a free card
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsAssignfreecardBody;
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

// Set card info to the request body
$body = new ActionsAssignfreecardBody();
$body->setCustomerId('83ad6b11209eaf4e2a18e0b319'); // string | The unique id for the cardholder
$body->setCardTypeId('8bed991c68a470e7aaeffbf048'); // string | The unique id for the card type

// Call endpoint and post data
try {
    $post_assign_card = $care_cloud->cardsApi()->postAssignCard($body, $accept_language);
    $card_id = $post_assign_card->getData()->getCardId();
    var_dump($card_id);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}