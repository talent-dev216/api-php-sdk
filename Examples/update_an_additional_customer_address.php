<?php
/**
 * Update an additional customer address
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\AdditionalAddress;
use CrmCareCloud\Webservice\RestApi\Client\Model\Address;
use CrmCareCloud\Webservice\RestApi\Client\Model\AddressesAdditionalCustomerAddressIdPathBody;
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
$customer_id = '8ea2591121e636086a4a9c0992'; // string | The unique id of the customer
$additional_customer_address_id_path = '86e05affc7a7abefcd513ab400'; // string | Unique ID of the customer additional address

// Set additional address
$address = new Address();
$address->setAddress1('Namesti Miru 2'); // string | Street name of the address
$address->setAddress2('12'); // string | Street number (Land registry number)
$address->setAddress3(null); // string | House number
$address->setAddress4(null); // string | Next address line
$address->setAddress5(null); // string | Next address line
$address->setAddress6(null); // string | Next address line
$address->setAddress7(null); // string | Next address line
$address->setZip('11002'); // string | Zip code
$address->setCity('Prague 3'); // string | City
$address->setCountryCode('cz'); // string | ISO code of the country Possible values de / gb / us / it / cz / etc.

$additional_address = new AdditionalAddress();
$additional_address->setAddressType('86e05affc7a7abefcd513ab400'); // string | The unique id of the type of the address
$additional_address->setAddress($address);

// Set additional address to the request body
$body = new AddressesAdditionalCustomerAddressIdPathBody();
$body->setAdditionalAddress($additional_address);

// Call endpoint and put data
try {
    $care_cloud->customersApi()->putSubCustomerAddress(
        $body,
        $customer_id,
        $additional_customer_address_id_path,
        $accept_language
    );
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}