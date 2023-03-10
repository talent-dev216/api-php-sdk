<?php
/**
 * Create a new booking
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\Booking;
use CrmCareCloud\Webservice\RestApi\Client\Model\BookingItem;
use CrmCareCloud\Webservice\RestApi\Client\Model\BookingsBody;
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
//$booking_id = '89cc1c4476e0ec8aa25f46cbff'; // string | The unique id of the booking

// Set the request body
$booking_item1 = new BookingItem();
$booking_item1->setTimeSlotId('82b6d539997857de914f2252a1'); // string | The unique id of the booking time slot
$booking_item1->setCreatedAt('2023-03-08 10:47:34'); // string | Date and time of the booking (YYYY-MM-DD HH:MM:SS)
$booking_item1->setCustomerId('85bc5819e09dab95437552ce79'); // string | The unique id of the customer

$booking = new Booking();
$booking->setCustomerId('85bc5819e09dab95437552ce79'); // string | The unique id of the customer (optional)
$booking->setBookingItems(array($booking_item1)); // BookingItem[] | List of the booking items
$booking->setBookingStatus(null); //string | Current status of the booking from resource booking-statuses. If not set, CareCloud uses default booking status.
$booking->setCreatedAt('2023-03-08 10:51:34'); // string | Date and time of the booking (YYYY-MM-DD HH:MM:SS)

$body = new BookingsBody();
$body->setBooking($booking);

// Call endpoint and post data
try
{
    $post_booking = $care_cloud->bookingsApi()->postBooking(
        $body,
        $accept_language
    );
    $booking_id = $post_booking->getData()->getBookingId();
    var_dump($booking_id);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}