<?php
/**
 * Update a card
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\Card;
use CrmCareCloud\Webservice\RestApi\Client\Model\CardsCardIdBody;
use CrmCareCloud\Webservice\RestApi\Client\SDK\CareCloud;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Config;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Data\AuthTypes;

require_once '../vendor/autoload.php';

$project_uri     = 'https://yourapiurl.com/webservice/rest-api/enterprise-interface/v1.0';
$login           = 'login';
$password        = 'password';
$external_app_id = 'application_id';
$auth_type       = AuthTypes::BEARER_AUTH;
// Or if using basic auth, just change the AuthType to Basic Auth
// $authType      = AuthTypes::BASIC_AUTH;

$config = new Config($project_uri, $login, $password, $external_app_id, $auth_type);

$care_cloud = new CareCloud($config);

// Set Header parameter Accept-Language
$accept_language = 'en'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set path parameter
$card_id = '82db62087b0f79a6e14e5747e7'; // string | The unique id of the card

// Set card info
$card = new Card();
$card->setCustomerId('8fac83212755b729a2f3f9bbb0'); // string | The unique id for the card holder
$card->setCardTypeId('81eaeea13b8984a169c490a325'); // string | The unique id for the card type
$card->setCardNumber('CARD1011'); // string | Card number
$card->setValidFrom('2022-10-17 16:18:00'); // string | Card validity from (YYYY-MM-DD HH:MM:SS)
$card->setValidTo('2023-10-17 16:18:00'); // string | Card validity to (YYYY-MM-DD HH:MM:SS)
$card->setStoreId(null); // string | The unique id for the store, where the card was assigned to a customer
$card->setState(1); // integer | State of the card Possible values are: 0 - blocked / 1 - active

// Set card info to the request body
$body = new CardsCardIdBody();
$body->setCard($card);

// Call endpoint and put data
try {
    $care_cloud->cardsApi()->putCard($body, $card_id, $accept_language);
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}