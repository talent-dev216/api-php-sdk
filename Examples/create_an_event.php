<?php
/**
 * Create a new event
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\Event;
use CrmCareCloud\Webservice\RestApi\Client\Model\EventsBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\PropertyRecord;
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

// Set the event data
$event = new Event();
$event->setEventTypeId('82d0f9d976dee39aacd13dc7ea'); // string | The unique id of the event type
$event->setCustomerId('8ea2591121e636086a4a9c0992'); // string | The unique id for the card holder
$event->setExternalId('e123'); // string | The unique external id of the event
$event->setData(null); // string, string[] or object | Additional data of the event. Serialized data in JSON (optional)
$event->setCreatedAt(null); // string | Date and time of the event (YYYY-MM-DD HH:MM:SS) (optional)
$event->setSecondaryExternalId(null); // string | Additional external id of the event (optional)

$property_record = new PropertyRecord();
$property_record->setPropertyId('account_event_type_records_count'); // string | The unique id of the property
$property_record->setPropertyValue(2); // (string or null) or (number or null) or (integer or null) or (boolean or null) or (Array of any or null) or (object or null) | Value of the property (optional)

// Set the request body
$body = new EventsBody();
$body->setEvent($event);
$body->setPropertyRecords(array($property_record)); // array of objects | List of an event property records (optional)

// Call endpoint and post data
try {
    $post_event = $care_cloud->eventsApi()->postEvent($body, $accept_language);
    $event_id = $post_event->getData()->getEventId();
    var_dump($event_id);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}