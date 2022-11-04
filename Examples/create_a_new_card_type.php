<?php
/**
 * Create a new card type
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\CardType;
use CrmCareCloud\Webservice\RestApi\Client\Model\CardtypesBody;
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

// Set card type data
$card_type = new CardType();
$card_type->setName('New card type name'); // string | Name of the card type
$card_type->setPrefix('12'); // string | Prefix of the specific card type cards

// Set data to the request body
$body = new CardtypesBody();
$body->setCardType($card_type);

// Call endpoint and post data
try
{
    $post_card_type = $care_cloud->cardTypesApi()->postCardType($body, $accept_language);
    $new_card_type_id = $post_card_type->getData()->getCardTypeId();
    var_dump($new_card_type_id);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}