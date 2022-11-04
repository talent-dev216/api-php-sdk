<?php
/**
 * Create a card
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\Card;
use CrmCareCloud\Webservice\RestApi\Client\Model\CardsBody;
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

// Set card info
$card = new Card();
$card->setCustomerId('87af991126405bf8e7dfb36045'); // string | The unique id for the card holder
$card->setCardTypeId('81eaeea13b8984a169c490a325'); // string | The unique id for the card type
$card->setCardNumber('CARD10101'); // string | Card number
$card->setValidFrom('2022-10-18 16:18:00'); // string | Card validity from (YYYY-MM-DD HH:MM:SS)
$card->setValidTo('2023-10-18 16:18:00'); // string | Card validity to (YYYY-MM-DD HH:MM:SS)
$card->setStoreId(null); // string | The unique id for the store, where the card was assigned to a customer
$card->setState(1); // integer | State of the card Possible values are: 0 - blocked / 1 - active

$body = new CardsBody();
$body->setCard($card);

// Call endpoint and post data
try
{
    $post_card = $care_cloud->cardsApi()->postCard($body, $accept_language);
    $card_id = $post_card->getData()->getCardId();
    var_dump($card_id);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}