<?php

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\Address;
use CrmCareCloud\Webservice\RestApi\Client\Model\Agreement;
use CrmCareCloud\Webservice\RestApi\Client\Model\Card;
use CrmCareCloud\Webservice\RestApi\Client\Model\CustomAgreements;
use CrmCareCloud\Webservice\RestApi\Client\Model\Customer;
use CrmCareCloud\Webservice\RestApi\Client\Model\CustomerIdInterestrecordsBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\CustomerIdPropertyrecordsBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\CustomersBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\CustomersCustomerIdBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\CustomerSourceRecord;
use CrmCareCloud\Webservice\RestApi\Client\Model\InterestRecord;
use CrmCareCloud\Webservice\RestApi\Client\Model\PersonalInformation;
use CrmCareCloud\Webservice\RestApi\Client\Model\PropertyRecord;
use CrmCareCloud\Webservice\RestApi\Client\Model\SocialNetworkCredentials;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Config;
use CrmCareCloud\Webservice\RestApi\Client\SDK\CareCloud;

require_once '../vendor/autoload.php';
require_once 'config.php';

$config = new Config($projectUri, $login, $password, $externalAppId, $authType);
$careCloud = new CareCloud($config);

/**
 * Get all rewards for a specific customer
 */
// Set Header parameter Accept-Language
$accept_language = 'cs'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set method parameters
$customer_id = '8bed991c68a470e7aaeffbf048'; // string | Id of customer
$rewards = true; // boolean | false - we don't want to get rewards / true - get rewards
$reward_group = null; // integer | null - all groups / 0 - cash desk reward (party time reward) / 1 - catalog reward
$vouchers = true; // boolean | false - we don't want to get vouchers / true - get vouchers
$campaign_products = true; // boolean | false - we don't want to get campaign products / true - get campaign products
$is_valid = null; // boolean | true / false / null - all
$customer_type_id = null; // By resource customer-types

// Call endpoints and get data
try {
    $allRewards = $careCloud->customersApi()->getAllRewards($customer_id, $rewards, $reward_group, $vouchers, $campaign_products, $is_valid, $customer_type_id, $accept_language);
    print_r($allRewards);
    die();
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}

/**
 * Create a new customer
 */
// Set Header parameter Accept-Language
$accept_language = 'cs'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set address of new customer
$address = new Address();
$address->setAddress1('Old Town Square') // string | Street name of the address
->setAddress2('34') // string | Street number (Land registry number)
->setAddress3('12') // string | House number
->setZip('11000') // string | ZIP code
->setCity('Prague 1') // string | City
->setCountryCode('cz'); // string | ISO code of the country Possible values de / gb / us / it / cz / etc.

// Set custom agreements of new customer
$custom_agreement1 = new CustomAgreements();
$custom_agreement1->setAgreementId('custom_agreement_id') // string | The unique id of the agreement in CareCloud
->setAgreementValue(1); // integer | Value of the specific agreement Possible values: 0 - no, consent canceled / 1 - yes, consent given / 2 - consent not set
$custom_agreement2 = new CustomAgreements();
$custom_agreement2->setAgreementId('second_custom_agreement_id') // string | The unique id of the agreement in CareCloud
->setAgreementValue(1); // integer | Value of the specific agreement Possible values: 0 - no, consent canceled / 1 - yes, consent given / 2 - consent not set

$custom_agreements = [
    $custom_agreement1,
    $custom_agreement2,
];

// Set agreement of new customer
$agreement = new Agreement();
$agreement->setAgreementGtc(1) // integer | Consent to General Terms & Conditions Possible values: 0 - no, consent canceled / 1 - yes, consent given / 2 - consent not set
->setAgreementProfiling(1) // integer | Consent to profiling Possible values: 0 - no, consent canceled / 1 - yes, consent given / 2 - consent not set
->setAgreementMarketingCommunication(0) // integer | Consent to marketing communication Possible values: 0 - no, consent canceled / 1 - yes, consent given / 2 - consent not set
->setCustomAgreements($custom_agreements);

// Set personal information of new customer
$personal_information = new PersonalInformation();
$personal_information->setGender(1) // integer | Gender of the customer Possible values: 1 - male, 2 - female
->setFirstName('John') // string | First name of the customer
->setLastName('Smith') // string | Last name of the customer
->setBirthdate('1985-02-12') // string <date> | Customer's date of birth (YYYY-MM-DD)
->setEmail('happy_customer@crmcarecloud.com') // string | Email of the customer
->setPhone('420523828931') // string | Phone number of the customer with international prefix (420000000000)
->setLanguageId('cs') // string | The unique id for the language by ISO 639 code
->setStoreId('8bed991c68a4') // string | The unique id for the original customer account store of registration
->setPhotoUrl(null) // string | URL address of the customer photo. If customer has no photo, this parameter is not send
->setAddress($address)
    ->setAgreement($agreement);

$customer = new Customer();
$customer->setPersonalInformation($personal_information);

// Set source record of new customer from object (CustomerSourceRecord)
$customer_source = new CustomerSourceRecord();
$customer_source->setCustomerSourceId('8fd73167342d06899c4c015320') // string | The unique id of the customer source. It identifies the system where the customer belongs or the customer account was created
->setExternalId('external-id'); // string | The unique external id of the customer. It may be id from the other system

// Set customer Social network credentials
$social_network_credentials = new SocialNetworkCredentials();
$social_network_credentials->setSocialNetworkId('twitter') // string | The unique id of the social network
->setSocialNetworkToken('38e123j1jedu12d1jnjqwd'); // string | Social network customer's token

// Set basic information about new customer
$body = new CustomersBody();
$body->setCustomer($customer)
    ->setCustomerSource($customer_source)
    ->setPassword('fO7mrC7spZjr') // string | Password of the customer.
    ->setAutologin(false) // boolean | If true, password is required and customer is logged in. Otherwise password is optional
    ->setSocialNetworkCredentials($social_network_credentials);

// Call endpoint and get data
try {
    $newCustomer = $careCloud->customersApi()->postCustomer($body, $accept_language);;
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}

/**
 * Create a new customer with extended method
 */
// Set Header parameter Accept-Language
$accept_language = 'cs'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set address of new customer
$address = new Address();
$address->setAddress1('Old Town Square') // string | Street name of the address
->setAddress2('34') // string | Street number (Land registry number)
->setAddress3('12') // string | House number
->setZip('11000') // string | ZIP code
->setCity('Prague 1') // string | City
->setCountryCode('cz'); // string | ISO code of the country Possible values de / gb / us / it / cz / etc.

// Set custom agreements of new customer
$custom_agreement1 = new CustomAgreements();
$custom_agreement1->setAgreementId('custom_agreement_id') // string | The unique id of the agreement in CareCloud
->setAgreementValue(1); // integer | Value of the specific agreement Possible values: 0 - no, consent canceled / 1 - yes, consent given / 2 - consent not set
$custom_agreement2 = new CustomAgreements();
$custom_agreement2->setAgreementId('second_custom_agreement_id') // string | The unique id of the agreement in CareCloud
->setAgreementValue(1); // integer | Value of the specific agreement Possible values: 0 - no, consent canceled / 1 - yes, consent given / 2 - consent not set

$custom_agreements = [
    $custom_agreement1,
    $custom_agreement2,
];

// Set agreement of new customer
$agreement = new Agreement();
$agreement->setAgreementGtc(1) // integer | Consent to General Terms & Conditions Possible values: 0 - no, consent canceled / 1 - yes, consent given / 2 - consent not set
->setAgreementProfiling(1) // integer | Consent to profiling Possible values: 0 - no, consent canceled / 1 - yes, consent given / 2 - consent not set
->setAgreementMarketingCommunication(0) // integer | Consent to marketing communication Possible values: 0 - no, consent canceled / 1 - yes, consent given / 2 - consent not set
->setCustomAgreements($custom_agreements);

// Set personal information of new customer
$personal_information = new PersonalInformation();
$personal_information->setGender(1) // integer | Gender of the customer Possible values: 1 - male, 2 - female
->setFirstName('John') // string | First name of the customer
->setLastName('Smith') // string | Last name of the customer
->setBirthdate('1985-02-12') // string <date> | Customer's date of birth (YYYY-MM-DD)
->setEmail('happy_customer@crmcarecloud.com') // string | Email of the customer
->setPhone('420523828931') // string | Phone number of the customer with international prefix (420000000000)
->setLanguageId('cs') // string | The unique id for the language by ISO 639 code
->setStoreId('8bed991c68a4') // string | The unique id for the original customer account store of registration
->setPhotoUrl(null) // string | URL address of the customer photo. If customer has no photo, this parameter is not send
->setAddress($address)
    ->setAgreement($agreement);

$customer = new Customer();
$customer->setPersonalInformation($personal_information);

// Set source record of new customer from object (CustomerSourceRecord)
$customer_source = new CustomerSourceRecord();
$customer_source->setCustomerSourceId('8fd73167342d06899c4c015320') // string | The unique id of the customer source. It identifies the system where the customer belongs or the customer account was created
->setExternalId('external-id'); // string | The unique external id of the customer. It may be id from the other system

// Set customer Social network credentials
$social_network_credentials = new SocialNetworkCredentials();
$social_network_credentials->setSocialNetworkId('twitter') // string | The unique id of the social network
->setSocialNetworkToken('38e123j1jedu12d1jnjqwd'); // string | Social network customer's token

// Set basic information about new customer
$customerBody = new CustomersBody();
$customerBody->setCustomer($customer)
    ->setCustomerSource($customer_source)
    ->setPassword('fO7mrC7spZjr') // string | Password of the customer.
    ->setAutologin(false) // boolean | If true, password is required and customer is logged in. Otherwise password is optional
    ->setSocialNetworkCredentials($social_network_credentials);

// Set the card information that will be assigned to the customer
$card = new Card();
$card->setCardNumber('1000000000') // string | set card_number if you know it else set card_type_id
->setCardTypeId('8bed991c68a470e7aaeffbf048') // string | The unique id for the card type. (Required if we don't know the card number)
->setValidFrom('2021-11-01') // string | set the card validity from (YYYY-MM-DD)
->setValidTo('2022-11-02') // string | set the card validity to (YYYY-MM-DD)
->setStoreId(null); // string | assign a store id to the card

// Set property record
$property_record = new PropertyRecord();
$property_record->setPropertyId('custom_id') // string
->setPropertyName('Custom property name') // string
->setPropertyValue('Some value'); // string or integer or number or object or boolean or (Array of strings or integers or numbers or objects)

$propertyBody = new CustomerIdPropertyrecordsBody();
$propertyBody->setPropertyRecord($property_record);

// Set interest record
$interest_record = new InterestRecord();
$interest_record->setInterestId('81eaeea13b8984a169c490a325') // string | The unique id of the interest
->setCustomerId('89ac83ca207a820c62c79bf03a'); // string | The unique id of the customer

$interestBody = new CustomerIdInterestrecordsBody();
$interestBody->setInterestRecord($interest_record);

// Call endpoint and get data
try {
    $newCustomer = $careCloud->customersApi()->postCustomerExtended($customerBody, $card, $propertyBody, $interestBody, $accept_language);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}

/**
 * Get a list of all customers
 */
// Set Header parameter Accept-Language
$accept_language = 'cs'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set query parameters
$count = 100; // integer >= 1 | The number of records to return.
$offset = 0; // integer | The number of records from a collection to skip.
$sort_field = 'last_change'; // string | One of the query string parameters for sorting. Response is sorted by the specified field.
$sort_direction = 'DESC'; // string | Direction of sorting the response list.
$email = 'happy_customer@crmcarecloud.com'; // string | Search by email
$phone = '420523828931'; // string | Phone number with international prefix (420000000)
$customer_source_id = null; // string | The unique id of the customer source. It identifies the system where the customer belongs or the customer account was created
$first_name = 'John'; // string | Search by first name
$last_name = 'Smith'; // string | Search by last name
$birthdate = '1985-02-12'; // string | Customer's date of birth. Possible values are: YYYY-MM-DD / DD.MM.YYYY

// Call endpoint and get data
try {
    $getCustomers = $careCloud->customersApi()->getCustomers($accept_language, $count, $offset, $sort_field, $sort_direction, $email, $phone, $customer_source_id, $first_name, $last_name, $birthdate);
    $customers = $getCustomers->getData()->getCustomers();
    $totalItems = $getCustomers->getData()->getTotalItems();
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}

/**
 * Get information about a specific customer account
 */
// Set Header parameter Accept-Language
$accept_language = 'cs'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set path parameter
$customer_id = '87af991126405bf8e7dfb36045'; // string | The unique id for the customer

// Call endpoint and get data
try {
    $getCustomer = $careCloud->customersApi()->getCustomer($customer_id, $accept_language);
    $customer = $getCustomer->getData();
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}

/**
 * Update the information on a specific customer account
 */
// Set Header parameter Accept-Language
$accept_language = 'cs'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set path parameter
$customer_id = '87af991126405bf8e7dfb36045'; // string | The unique id for the customer

// Set address of customer
$address = new Address();
$address->setAddress1('Old Town Square') // string | Street name of the address
->setAddress2('34') // string | Street number (Land registry number)
->setAddress3('12') // string | House number
->setZip('11000') // string | ZIP code
->setCity('Prague 1') // string | City
->setCountryCode('cz'); // string | ISO code of the country Possible values de / gb / us / it / cz / etc.

// Set custom agreements of customer
$custom_agreement1 = new CustomAgreements();
$custom_agreement1->setAgreementId('custom_agreement_id') // string | The unique id of the agreement in CareCloud
->setAgreementValue(1); // integer | Value of the specific agreement Possible values: 0 - no, consent canceled / 1 - yes, consent given / 2 - consent not set
$custom_agreement2 = new CustomAgreements();
$custom_agreement2->setAgreementId('second_custom_agreement_id') // string | The unique id of the agreement in CareCloud
->setAgreementValue(1); // integer | Value of the specific agreement Possible values: 0 - no, consent canceled / 1 - yes, consent given / 2 - consent not set

$custom_agreements = [
    $custom_agreement1,
    $custom_agreement2,
];

// Set agreement of customer
$agreement = new Agreement();
$agreement->setAgreementGtc(1) // integer | Consent to General Terms & Conditions Possible values: 0 - no, consent canceled / 1 - yes, consent given / 2 - consent not set
->setAgreementProfiling(1) // integer | Consent to profiling Possible values: 0 - no, consent canceled / 1 - yes, consent given / 2 - consent not set
->setAgreementMarketingCommunication(0) // integer | Consent to marketing communication Possible values: 0 - no, consent canceled / 1 - yes, consent given / 2 - consent not set
->setCustomAgreements($custom_agreements);

// Set personal information of customer
$personal_information = new PersonalInformation();
$personal_information->setGender(1) // integer | Gender of the customer Possible values: 1 - male, 2 - female
->setFirstName('John') // string | First name of the customer
->setLastName('Smith') // string | Last name of the customer
->setBirthdate('1985-02-12') // string <date> | Customer's date of birth (YYYY-MM-DD)
->setEmail('happy_customer@crmcarecloud.com') // string | Email of the customer
->setPhone('420523828931') // string | Phone number of the customer with international prefix (420000000000)
->setLanguageId('cs') // string | The unique id for the language by ISO 639 code
->setStoreId('8bed991c68a4') // string | The unique id for the original customer account store of registration
->setPhotoUrl(null) // string | URL address of the customer photo. If customer has no photo, this parameter is not send
->setAddress($address)
    ->setAgreement($agreement);

$customer = new Customer();
$customer->setPersonalInformation($personal_information);

// Set customer Social network credentials
$social_network_credentials = new SocialNetworkCredentials();
$social_network_credentials->setSocialNetworkId('twitter') // string | The unique id of the social network
->setSocialNetworkToken('38e123j1jedu12d1jnjqwd'); // string | Social network customer's token

// Set basic information about customer
$body = new CustomersCustomerIdBody();
$body->setCustomer($customer)
    ->setPassword('fO7mrC7spZjr') // string | Password of the customer.
    ->setSocialNetworkCredentials($social_network_credentials);

// Call endpoint and get data
try {
    $putCustomer = $careCloud->customersApi()->putCustomer($body, $customer_id, $accept_language);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}
