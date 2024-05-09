<?php
/**
 * Create a batch of cards
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\Card;
use CrmCareCloud\Webservice\RestApi\Client\Model\CardsBatchBody;
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

// Set the request body
$card1 = new Card();
$card1->setCustomerId('8ea2591121e636086a4a9c0992'); // string | The unique id of the customer (optional)
$card1->setCardTypeId('8bed991c68a470e7aaeffbf048'); // string | The unique id of the card type (optional)
$card1->setCardNumber('20230310001'); // string | The number of the card
$card1->setValidFrom(null); // string | Card validity from (YYYY-MM-DD HH:MM:SS) (optional)
$card1->setValidTo(null); // string | Card validity to (YYYY-MM-DD HH:MM:SS) (optional)
$card1->setStoreId(null); // string | The unique id of the store (optional)
$card1->setState(1); // integer | Possible values are: 0 - blocked / 1 - active

$body = new CardsBatchBody();
$body->setCards([$card1]);

// Call endpoint and post data
try {
    $care_cloud->cardsApi()->postBatchCards(
        $body,
        $accept_language
    );
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}