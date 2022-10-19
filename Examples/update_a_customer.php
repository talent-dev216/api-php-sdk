<?php
/**
 * Update a customer
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\Address;
use CrmCareCloud\Webservice\RestApi\Client\Model\Agreement;
use CrmCareCloud\Webservice\RestApi\Client\Model\CustomAgreements;
use CrmCareCloud\Webservice\RestApi\Client\Model\Customer;
use CrmCareCloud\Webservice\RestApi\Client\Model\CustomersCustomerIdBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\PersonalInformation;
use CrmCareCloud\Webservice\RestApi\Client\Model\SocialNetworkCredentials;
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
$customer_id = '85aae99524edceec17682e01b9'; // string | The unique id of the customer

// Set address of a new customer (optional)
$address = new Address();
$address->setAddress1('New Town Square') // string | Street name of the address (optional)
->setAddress2('24') // string | Street number/land registry number (optional)
->setAddress3('22') // string | House number (optional)
->setZip('11001') // string | ZIP code (optional)
->setCity('Prague 2') // string | City (optional)
->setCountryCode('cz'); // string | ISO code of the country Possible values de / gb / us / it / cz / etc. (optional)

// Set custom agreements of a new customer (optional)
$custom_agreement1 = new CustomAgreements();
$custom_agreement1->setAgreementId('89ce2a1b9b01f5c939fb1e20cd'); // string | The unique id of the agreement in CareCloud
$custom_agreement1->setAgreementValue(1); // integer | Value of the specific agreement Possible values: 0 - no, consent canceled / 1 - yes, consent given / 2 - consent not set
$custom_agreement2 = new CustomAgreements();
$custom_agreement2->setAgreementId('8fd73167342d06899c4c015320'); // string | The unique id of the agreement in CareCloud
$custom_agreement2->setAgreementValue(1); // integer | Value of the specific agreement Possible values: 0 - no, consent canceled / 1 - yes, consent given / 2 - consent not set

$custom_agreements = array(
    $custom_agreement1,
    $custom_agreement2
);

// Set agreement of a new customer
$agreement = new Agreement();
$agreement->setAgreementGtc(1) // integer | Consent to General Terms & Conditions Possible values: 0 - no, consent canceled / 1 - yes, consent given / 2 - consent not set
->setAgreementProfiling(1) // integer | Consent to profiling Possible values: 0 - no, consent canceled / 1 - yes, consent given / 2 - consent not set
->setAgreementMarketingCommunication(0) // integer | Consent to marketing communication Possible values: 0 - no, consent canceled / 1 - yes, consent given / 2 - consent not set
->setCustomAgreements($custom_agreements);

// Set personal information of a new customer
$personal_information = new PersonalInformation();
$personal_information->setSalutation('Mr. Doe') // string | Customers salutation (optional)
->setGender(1) // integer | Gender of the customer Possible values: 1 - male, 2 - female (optional)
->setFirstName('John') // string | First name of the customer (optional)
->setLastName('Doe') // string | Last name of the customer (optional)
->setBirthdate('1990-01-01') // string <date> | Customer's date of birth (YYYY-MM-DD) (optional)
->setEmail('doe@crmcarecloud.com') // string | Email of the customer (optional)
->setPhone('420523828932') // string | Phone number of the customer with international prefix (420000000000) (optional)
->setLanguageId('cs') // string | The unique id for the language by ISO 639 code
->setStoreId(null) // string | The unique id for the original customer account store of registration (optional)
->setPhotoUrl(null) // string | URL address of the customer photo (optional)
->setAddress($address)
    ->setAgreement($agreement);

$customer = new Customer();
$customer->setPersonalInformation($personal_information);

// Set customer Social network credentials (optional)
$social_network_credentials = new SocialNetworkCredentials();
$social_network_credentials->setSocialNetworkId('instagram'); // string | The unique id of the social network
$social_network_credentials->setSocialNetworkToken('38e223j1jedu12d1jnjqwd'); // string | Social network customer's token

// Set basic information about new customer
$body = new CustomersCustomerIdBody();
$body->setCustomer($customer)
    ->setPassword(null) // string | If parameter autologin=true, password is required, otherwise is optional.
    ->setSocialNetworkCredentials($social_network_credentials);

// Call endpoint and put data
try {
    $care_cloud->customersApi()->putCustomer($body, $customer_id, $accept_language);
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}