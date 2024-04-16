<?php

declare(strict_types=1);

use CrmCareCloud\Webservice\RestApi\Client\Model\Address;
use CrmCareCloud\Webservice\RestApi\Client\Model\Agreement;
use CrmCareCloud\Webservice\RestApi\Client\Model\CustomAgreements;
use CrmCareCloud\Webservice\RestApi\Client\Model\Customer;
use CrmCareCloud\Webservice\RestApi\Client\Model\CustomersBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\CustomerSourceRecord;
use CrmCareCloud\Webservice\RestApi\Client\Model\PersonalInformation;
use CrmCareCloud\Webservice\RestApi\Client\Model\PropertyRecord;
use CrmCareCloud\Webservice\RestApi\Client\SDK\CareCloud;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Config;

require_once '../vendor/autoload.php';
/** @var Config $config */
require_once 'config.php';

$careCloud = new CareCloud($config);
try {
    $external_id = "1HGFDHDFdGHFFd";
    $customer_source_id = "86e05affc7a7abefcd513ab400";
    $accept_language = "cs";
    $address = new Address([
        "address1" => "Ulice",
        "address2" => "Popisné",
        "address3" => "Směrovací",
        "address4" => "Doručovací",
        "address5" => "Fakturovací",
        "address6" => "Zaměřovací",
        "address7" => "Stěhovací",
        "zip" => "53002",
        "city" => "Poděbradice",
        "country_code" => "cz",
    ]);
    $agreement = new Agreement([
        "agreement_gtc" => 1,
        "agreement_profiling" => 1,
        "agreement_marketing_communication" => 1,
        "custom_agreements" => [
            new CustomAgreements([
                "agreement_id" => "8fd73167342d06899c4c015320",
                "agreement_value" => 1,
            ]),
        ],
    ]);
    $customer = new Customer([
        "personal_information" => new PersonalInformation([
            "salutation" => "Pane",
            "gender" => 1,
            "first_name" => "Testovací",
            "last_name" => "Uživatel",
            "pre_nominals" => "Ing.",
            "post_nominals" => "MBA",
            "birthdate" => "29.2.2024",
            "email" => "testovaci@uzivatel.cz",
            "phone" => "+420745924375",
            "language_id" => $accept_language,
            "store_id" => "8bed991c68a470e7aaeffbf048",
            "address" => $address,
            "agreement" => $agreement,
        ]),
    ]);
    $customer_source = new CustomerSourceRecord([
        "customer_source_id" => $customer_source_id,
        "external_id" => $external_id,
    ]);
    $property_records = [
        new PropertyRecord([
            "property_id" => "p1_oblibena_prodejna",
            "property_value" => "8bed991c68a470e7aaeffbf048",
        ]),
    ];
    $customers_body = new CustomersBody([
        "customer" => $customer,
        "customer_source" => $customer_source,
        "password" => "testovaci_heslo",
        "autologin" => true,
        "property_records" => $property_records,
    ]);
    $result = $careCloud->customersApi()->synchronizeCustomer($careCloud, $customers_body, $accept_language, $customer_source_id, $external_id);
    var_dump($result);
} catch (\Throwable $exception) {
    var_dump($exception);
}
