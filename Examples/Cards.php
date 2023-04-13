<?php

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Config;
use CrmCareCloud\Webservice\RestApi\Client\SDK\CareCloud;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Data\AuthTypes;

require_once '../vendor/autoload.php';
require_once 'config.php';

$config = new Config($projectUri, $login, $password, $externalAppId, $authType);
$careCloud = new CareCloud($config);

/**
 * Get all cards
 */
try {
    $cards = $careCloud->cardsApi()->getCards();
    $items = $cards->getData()->getCards();
    $totalItems = $cards->getData()->getTotalItems();
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}

/**
 * Assigning a free card to a customer
 */
// Set Header parameter Accept-Language
$accept_language = 'cs'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set method parameters
$card_number = '1000000000030'; // string | number of the searched card
$customer_id = '82ab3d112cba4cb26c9b6eafbd'; // string | customer id for assignment to a free card
$valid_from = '2021-08-01'; // string | set the card validity from (YYYY-MM-DD)
$valid_to = '2025-08-01'; // string | set the card validity to (YYYY-MM-DD)
$store_id = null; // string | assign a store id to the card

// Call endpoint and get data
try {
    $assignCard = $careCloud->cardsApi()->putUnassignedCard($card_number, $customer_id, $valid_from, $valid_to, $store_id, $accept_language);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}
