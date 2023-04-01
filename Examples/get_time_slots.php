<?php
/**
 * Get a collection time slots depends on booking ticket
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
$booking_ticket_id = '89d88719b8b442de2d11b401a2'; // string | The unique id of the booking ticket

// Set query parameters
$count = 10; // integer >= 1 | The number of records to return (optional, default is 100)
$offset = 0; // integer | The number of records from a collection to skip (optional, default is 0)
$sort_field = null; // string | One of the query string parameters for sorting (optional, default is null)
$sort_direction = 'DESC'; // string | Direction of sorting the response list (optional, default is null)
$free_only = null; // bool | Possible values: true - returns all time slots with free capacity. / false - returns all occupied time slots. / no value - all time slots are returned (optional)
$time_from = null; // string | Filter results on the start of the time interval. (YYYY-MM-DD HH:MM:SS) (optional)
$time_to = null; // string | Filter results on the end of the time interval. (YYYY-MM-DD HH:MM:SS) (optional)
$booking_ticket_property_id = null; // string | Booking ticket property id from resource booking-ticket-properties. (optional)
$booking_ticket_property_value = null; // string | Booking ticket property record value from booking-ticket-properties in case of datatype with multiple values (optional)

// Call endpoint and get data
try {
    $get_booking_time_slots = $care_cloud->bookingTicketsApi()->getSubBookingTicketsTimeSlots(
        $booking_ticket_id,
        $accept_language,
        $count,
        $offset,
        $sort_field,
        $sort_direction,
        $free_only,
        $time_from,
        $time_to,
        $booking_ticket_property_id,
        $booking_ticket_property_value
    );
    $booking_time_slots = $get_booking_time_slots->getData()->getTimeSlots();
    $total_items = $get_booking_time_slots->getData()->getTotalItems();
    var_dump($booking_time_slots);
    var_dump($total_items);
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}