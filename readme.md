# CareCloud PHP SDK

This package provides a convenient wrapper around CareCloud PHP Client.

## Installation
You can install this package with composer

```shell
composer require crmcarecloud/sdk-php
```

## Client setup
You need to create the client first:

```php
use CrmCareCloud\Webservice\RestApi\Client\SDK\Data\AuthTypes;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Data\Interfaces;

require_once '../vendor/autoload.php';

$projectUri    = 'https://yourapiurl.com/webservice/rest-api/enterprise-interface/v1.0';
$login         = 'login';
$password      = 'pass';
$externalAppId = 'appId';
$authType      = AuthTypes::TOKEN; 
// Or if using basic auth, just change the AuthType to Basic Auth
// $authType      = AuthTypes::BASIC_AUTH;

$config = new Config( $projectUri, $login, $password, $externalAppId, $authType, $interface );

$careCloud = new CareCloud( $config );

```

Now you can access all the API endpoints from the `$client` object:

```php
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
```

## Examples

### Get all customers

```php
/**
 * Get a list of all customers
 */
// Set Header parameter Accept-Language
$accept_language = 'cs'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set query parameters
$count               = 100; // integer >= 1 | The number of records to return.
$offset              = 0; // integer | The number of records from a collection to skip.
$sort_field          = 'last_change'; // string | One of the query string parameters for sorting. Response is sorted by the specified field.
$sort_direction      = 'DESC'; // string | Direction of sorting the response list.
$email               = 'happy_customer@crmcarecloud.com'; // string | Search by email
$phone               = '420523828931'; // string | Phone number with international prefix (420000000)
$customer_source_id  = null; // string | The unique id of the customer source. It identifies the system where the customer belongs or the customer account was created
$first_name          = 'John'; // string | Search by first name
$last_name           = 'Smith'; // string | Search by last name
$birthdate           = '1985-02-12'; // string | Customer's date of birth. Possible values are: YYYY-MM-DD / DD.MM.YYYY

// Call endpoint and get data
try {
    $getCustomers  = $careCloud->customersApi()->getCustomers($accept_language, $count, $offset, $sort_field, $sort_direction, $email, $phone, $customer_source_id, $first_name, $last_name, $birthdate);
    $customers     = $getCustomers->getData()->getCustomers();
    $totalItems    = $getCustomers->getData()->getTotalItems();
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}
```

### Get information about a customer

```php
/**
 * Get information about a specific customer account
 */
// Set Header parameter Accept-Language
$accept_language = 'cs'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set path parameter
$customer_id     = '87af991126405bf8e7dfb36045'; // string | The unique id for the customer

// Call endpoint and get data
try {
    $getCustomer = $careCloud->customersApi()->getCustomer($customer_id, $accept_language);
    $customer    = $getCustomer->getData();
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}
```

### Update customer

```php
/**
 * Update the information on a specific customer account
 */
// Set Header parameter Accept-Language
$accept_language = 'cs'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set path parameter
$customer_id     = '87af991126405bf8e7dfb36045'; // string | The unique id for the customer

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
    $custom_agreement2
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
    $putCustomer = $careCloud->customersApi()->putCustomer( $body, $customer_id, $accept_language );
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}
```

For more examples, check the `Examples` folder.

## Extended methods

### Assigning a card to a customer

This method checks if the card is free and not blocked. If everything is OK, it assigns it to the specified customer. Additional information can be added to the card in this method.

```php
/**
 * Assigning a free card to a customer
 */
// Set Header parameter Accept-Language
$accept_language = 'cs'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set method parameters
$card_number  = '1000000000030'; // string | number of the searched card
$customer_id  = '82ab3d112cba4cb26c9b6eafbd'; // string | customer id for assignment to a free card
$valid_from   = '2021-08-01'; // string | set the card validity from (YYYY-MM-DD)
$valid_to     = '2025-08-01'; // string | set the card validity to (YYYY-MM-DD)
$store_id     = null; // string | assign a store id to the card

// Call endpoint and get data
try {
    $assignCard = $careCloud->cardsApi()->putUnassignedCard($card_number, $customer_id, $valid_from, $valid_to, $store_id, $accept_language);
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}
```

Response: 204 No Content

### Add a new customer

With this extended method, you can directly assign a card, set the customer's Properties records and Interests records when creating a customer.

If we know the card number it will look up and check availability. If it is available it is assigned to the created customer. If we do not know the number, any available card is assigned.

```php
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
    $custom_agreement2
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
                ->setPropertyValue( 'Some value'); // string or integer or number or object or boolean or (Array of strings or integers or numbers or objects)

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
    $newCustomer = $careCloud->customersApi()->postCustomerExtended($customerBody, $card, $propertyBody, $interestBody, $accept_language );
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}
```

Response 
```php
Array (
  [customer_id] => ...
  [card_id] => ...
  [property_record_id] => ...
  [interest_record_id] => ...
)
```


### Get all rewards for a specific customer

The method returns all rewards (Rewards, Vouchers, Campaign products) for a specific customer.

```php
/**
 * Get all rewards for a specific customer
 */
// Set Header parameter Accept-Language
$accept_language = 'cs'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set method parameters
$customer_id       = '8bed991c68a470e7aaeffbf048'; // string | Id of customer
$rewards           = true; // boolean | false - we don't want to get rewards / true - get rewards
$reward_group      = null; // integer | null - all groups / 0 - cash desk reward (party time reward) / 1 - catalog reward
$vouchers          = true; // boolean | false - we don't want to get vouchers / true - get vouchers
$campaign_products = true; // boolean | false - we don't want to get campaign products / true - get campaign products
$is_valid          = null; // boolean | true / false / null - all
$customer_type_id  = null; // By resource customer-types

// Call endpoints and get data
try {
    $allRewards = $careCloud->customersApi()->getAllRewards( $customer_id, $rewards, $reward_group, $vouchers, $campaign_products, $is_valid, $customer_type_id, $accept_language );
    die(print_r($allRewards));
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}
```
Response
```php
Array (
    [rewards] => Array (
            [items] => Array (
                    ...
                )
            [total_items] => 0
        )
)
```

## Caching

The SDK provides a mechanism to easily use any PSR-6 compatible Cache adapter to cache requests to specific endpoints.

### Cache example

We'll use Symfony Cache:
```shell
composer require symfony/cache
```

Setup the rules:

```php
use CrmCareCloud\Webservice\RestApi\Client\SDK\Cache\Rule;
$cache_rules  = [
    new Rule( 
        Rule::REQUEST_TYPE_GET, // Request type 
        'agreements',  // Path
        400 // TTL
    ),
];
```

Setup the Cache and pass it to the client:

```php
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Cache\Cache;
$cache = new Cache(
	new FilesystemAdapter( 'testCache', 0, __DIR__ ), // PSR-6 compatible Cache Pool, in our case Symfony FileAdapter
	$cache_rules
);
$careCloud = new CareCloud( $config, $cache );
```

Now all the `GET` requests to `agreements` endpoints are cached for `400 seconds`. For a complete example
check `Examples/Caching.php`. 
