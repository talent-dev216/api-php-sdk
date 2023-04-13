<?php
/**
 * Get a booking ticket property
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
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
$booking_ticket_property_id = 'firstname'; // string | The unique id of the booking ticket property

// Call endpoint and get data
try {
    $get_booking_ticket_property = $care_cloud->bookingTicketsPropertiesApi()->getBookingTicketProperty(
        $booking_ticket_property_id,
        $accept_language
    );
    $booking_ticket_property = $get_booking_ticket_property->getData();
    var_dump($booking_ticket_property);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}