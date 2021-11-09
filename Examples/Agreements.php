<?php

use CareCloud\ApiException;
use CareCloud\SDK\Config;
use CareCloud\SDK\CareCloud;

require_once '../vendor/autoload.php';
require_once 'config.php';

$config = new Config( $projectUri, $login, $password, $externalAppId, $authType );

$careCloud = new CareCloud( $config );

/**
 * Get a list of agreements accepted in CRM CareCloud
 */
try {
    $agreements = $careCloud->agreementsApi()->getAgreements();
	$items      = $agreements->getData()->getAgreements();
	$totalItems = $agreements->getData()->getTotalItems();
} catch ( ApiException $e ) {
	die( var_dump( $e->getResponseBody() ) );
}

/**
 * Get information about a specific agreement
 */
// Set Header parameter Accept-Language
$accept_language = 'cs'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set path parameter
$agreement_id = "81eaeea13b8984a169c490a325"; // string | The unique id of an agreement in CareCloud

try {
    $agreement = $careCloud->agreementsApi()->getAgreement($agreement_id, $accept_language);
    $name      = $agreement->getData()->getName();
    $text      = $agreement->getData()->getText();
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}
