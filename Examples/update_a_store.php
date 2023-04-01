<?php
/**
 * Update a store
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\Store;
use CrmCareCloud\Webservice\RestApi\Client\Model\StoresStoreIdBody;
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

// Set path parameters
$store_id = '80c0d6299ac63863b2e05e66fb'; // string | The unique id of the store

// Set the store info
$store = new Store();
$store->setStoreCode('candystorecode'); // string | The external code of the store
$store->setName('SuperCandyStore'); // string | The name of the store
$store->setStoreAddress(null); // object | The address of the store
$store->setContactEmail(null); // string | The contact email of the store (optional)
$store->setManagerName(null); // string | The name of the store manager (optional)
$store->setPhoneNumber(null); // string^[1-9][0-9]*$ Phone number of the store with international prefix (420000000000) (optional)
$store->setPartnerId('86e05affc7a7abefcd513ab400'); // string | The unique id of the partner
$store->setSystemId('candystoreid'); // string | The unique id of the store in the external system
$store->setGpsCoordinates(null); // object | GPS coordinates of the store (optional)
$store->setUrlAddress(null); // string | The URL of the store (optional)
$store->setOpening(null); // object | The list of the opening days (optional)
$store->setShortDescription(null); // string | The short description of the store (optional)
$store->setDescription(null); // string | The long description of the store (optional)
$store->setRegistrationId(null); // string | The legal registration number of the store (optional)

// Set the request body
$body = new StoresStoreIdBody();
$body->setStore($store);

// Call endpoint and put data
try {
    $care_cloud->storesApi()->putStore($body, $store_id, $accept_language);
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}