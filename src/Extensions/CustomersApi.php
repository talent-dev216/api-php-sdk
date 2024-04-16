<?php

namespace CrmCareCloud\Webservice\RestApi\Client\SDK\Extensions;

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Configuration;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsAssignfreecardBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\Card;
use CrmCareCloud\Webservice\RestApi\Client\Model\CardsCardIdBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\Customer;
use CrmCareCloud\Webservice\RestApi\Client\Model\CustomerIdInterestrecordsBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\CustomerIdPropertyrecordsBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\CustomersBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\CustomersCustomerIdBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\CustomerSourceRecord;
use CrmCareCloud\Webservice\RestApi\Client\SDK\CareCloud;
use Exception;
use GuzzleHttp\ClientInterface;

class CustomersApi extends \CrmCareCloud\Webservice\RestApi\Client\Api\CustomersApi
{
    private CareCloud $care_cloud;

    /**
     * @param ClientInterface $client
     * @param Configuration $config
     * @param CareCloud $care_cloud
     */
    public function __construct(ClientInterface $client, Configuration $config, CareCloud $care_cloud)
    {
        parent::__construct($client, $config);
        $this->care_cloud = $care_cloud;
    }

    /**
     * Get all rewards
     *
     * @param string $customer_id
     * @param bool $rewards
     * @param int|null $reward_group
     * @param bool $vouchers
     * @param bool $campaign_products
     * @param bool|null $is_valid
     * @param string|null $customer_type_id
     * @param string|null $accept_language
     *
     * @return array<array<mixed>>
     * @throws ApiException
     */
    public function getAllRewards(
        string $customer_id,
        bool $rewards = true,
        int $reward_group = null,
        bool $vouchers = true,
        bool $campaign_products = true,
        bool $is_valid = null,
        string $customer_type_id = null,
        string $accept_language = null
    ): array {
        $rewards_data = [];
        $total_rewards = 0;
        $vouchers_data = [];
        $total_vouchers = 0;
        $campaign_products_data = [];
        $total_campaign_products = 0;

        // We want get resource rewards
        if ($rewards) {
            if (is_null($customer_type_id)) {
                $customer_type_id_param = null;
            } else {
                $customer_type_id_param = array($customer_type_id);
            }
            $get_rewards = $this->getSubCustomerRewards(
                $customer_id,
                (is_null($accept_language) ? "" : $accept_language),
                100,
                0,
                null,
                null,
                null,
                null,
                $is_valid,
                null,
                null,
                null,
                null,
                $reward_group,
                $customer_type_id_param
            );
            $rewards_data = $get_rewards->getData()->getRewards();
            $total_rewards = $get_rewards->getData()->getTotalItems();
        }

        // We want to get resource vouchers
        if ($vouchers) {
            $get_vouchers = $this->getSubCustomerVouchers(
                $customer_id,
                (is_null($accept_language) ? "" : $accept_language),
                100,
                0,
                null,
                null,
                null,
                null,
                $is_valid
            );
            $vouchers_data = $get_vouchers->getData()->getVouchers();
            $total_vouchers = $get_vouchers->getData()->getTotalItems();
        }

        // We want to get resource campaign-products
        if ($campaign_products) {
            if (is_null($customer_type_id)) {
                $customer_type_id_param = null;
            } else {
                $customer_type_id_param = array($customer_type_id);
            }
            $get_campaign_products = $this->care_cloud->campaignProductsApi()->getCampaignProducts(
                (is_null($accept_language) ? "" : $accept_language),
                100,
                0,
                null,
                null,
                null,
                null,
                null,
                $customer_type_id_param
            );
            $campaign_products_data = $get_campaign_products->getData()->getCampaignProducts();
            $total_campaign_products = $get_campaign_products->getData()->getTotalItems();
        }

        return [
            'rewards' => [
                'items' => array_merge($rewards_data, $vouchers_data, $campaign_products_data),
                'total_items' => $total_rewards + $total_vouchers + $total_campaign_products,
            ],
        ];
    }

    /**
     * Save the customer extended
     *
     * @param CustomersBody $customer_body
     * @param Card|null $card
     * @param ?CustomerIdPropertyrecordsBody $property_body
     * @param ?CustomerIdInterestrecordsBody $interest_body
     * @param string|null $accept_language
     *
     * @return array<string, string|null>
     * @throws ApiException
     */
    public function postCustomerExtended(
        CustomersBody $customer_body,
        ?Card $card = null,
        ?CustomerIdPropertyrecordsBody $property_body = null,
        ?CustomerIdInterestrecordsBody $interest_body = null,
        string $accept_language = null
    ): array {
        // Card data
        $card_id = null;
        $state = (isset($card) ? $card->getState() : null);
        $card_number = (isset($card) ? $card->getCardNumber() : null);
        $valid_from = (isset($card) ? $card->getValidFrom() : null);
        $valid_to = (isset($card) ? $card->getValidTo() : null);
        $store_id = (isset($card) ? $card->getStoreId() : null);
        $card_type_id = (isset($card) ? $card->getCardTypeId() : null);

        $response = array(
            'card_id' => null,
            'property_record_id' => null,
            'interest_record_id' => null,
        );

        // Search for the card and verify that it is not assigned
        if ($card_number) {
            $unassigned_card = $this->care_cloud->cardsApi()->getUnassignedCard($card_number);
            $card_id = $unassigned_card->getCardId();
            $state = $unassigned_card->getState();
            $card_type_id = $unassigned_card->getCardTypeId();
        }

        // Create a new customer
        $new_customer = $this->postCustomer($customer_body, (is_null($accept_language) ? "" : $accept_language));
        $customer_id = $new_customer->getData()->getCustomerId();
        $response['customer_id'] = $customer_id;

        //assign the customer's searched card if it is free
        if ($card_number && $card_id) {
            $cart_body = new Card();
            $cart_body->setCustomerId($customer_id)
                ->setCardTypeId((is_null($card_type_id) ? "" : $card_type_id))
                ->setCardNumber($card_number)
                ->setValidFrom((is_null($valid_from) ? "" : $valid_from))
                ->setValidTo((is_null($valid_to) ? "" : $valid_to))
                ->setStoreId((is_null($store_id) ? "" : $store_id))
                ->setState((is_null($state) ? 0 : $state));

            $body = new CardsCardIdBody();
            $body->setCard($cart_body);

            $this->care_cloud->cardsApi()->putCard($body, $card_id, (is_null($accept_language) ? "" : $accept_language));
            // If we don't know the card number assign any free
        } else {
            if (!$card_type_id) {
                throw new Exception('To assign a free card you need to fill cardTypeId');
            }

            $body = new ActionsAssignfreecardBody();
            $body->setCardTypeId($card_type_id)
                ->setCustomerId($customer_id);

            $free_card = $this->care_cloud->cardsApi()->postAssignCard($body, (is_null($accept_language) ? "" : $accept_language));
            $card_id = $free_card->getData()->getCardId();
        }

        $response['card_id'] = $card_id;

        // Add a property to a customer if is set
        if ($property_body) {
            $property_record = $this->postSubCustomerProperties($property_body, $customer_id, (is_null($accept_language) ? "" : $accept_language));
            $property_record_id = $property_record->getData()->getPropertyRecordId();
            $response['property_record_id'] = $property_record_id;
        }

        // Add an interest record to a customer if is set
        if ($interest_body) {
            $interest_record = $this->postSubCustomerInterest($interest_body, $customer_id, (is_null($accept_language) ? "" : $accept_language));
            $interest_record_id = $interest_record->getData()->getInterestRecordId();
            $response['interest_record_id'] = $interest_record_id;
        }

        return $response;
    }

    /**
     * @param CareCloud $care_cloud
     * @param CustomersBody $customers_body
     * @param string $accept_language
     * @param string $customer_source_id
     * @param string $external_id
     *
     * @return Customer
     * @throws ApiException
     */
    public function synchronizeCustomer(
        CareCloud $care_cloud,
        CustomersBody $customers_body,
        string $accept_language,
        string $customer_source_id,
        string $external_id
    ): Customer {
        //search source record by $external_id & $customer_source_id
        $get_source_record = $care_cloud->customerSourceRecordsApi()->getCustomerSourceRecords(
            $accept_language,
            100,
            0,
            null,
            null,
            null,
            $external_id,
            $customer_source_id
        );
        $source_record = $get_source_record->getData()->getCustomerSourceRecords();
        //source record was found, do updating
        if (count($source_record) > 0) {
            $body = new CustomersCustomerIdBody();
            $body->setCustomer($customers_body->getCustomer())
                ->setPassword($customers_body->getPassword())
                ->setSocialNetworkCredentials($customers_body->getSocialNetworkCredentials());

            //update customer
            $source_record = reset($source_record);
            $customer_id = $source_record->getCustomerId();
            $this->putCustomer($body, $customer_id, $accept_language);

            //get updated customer by its id
            $get_customer = $this->getCustomer($customer_id, $accept_language);
            $customer_record = $get_customer->getData();

            //if we have customer's property records passed, we have to delete existing and add those that were passed
            $get_property_records = $this->getSubCustomerProperties($customer_id, $accept_language);
            $property_records = $get_property_records->getData()->getPropertyRecords();
            $total_items = $get_property_records->getData()->getTotalItems();

            //updating properties if there are any
            if ($total_items > 0 && count($customers_body->getPropertyRecords()) > 0) {
                foreach ($customers_body->getPropertyRecords() as $new_property) {
                    foreach ($property_records as $property_record) {
                        //delete current property value
                        if ($property_record->getPropertyId() === $new_property->getPropertyId()) {
                            $this->deleteSubCustomerProperty($customer_id, $property_record->getPropertyRecordId(), $accept_language);
                        }
                    }
                    //create property with new value
                    $body = new CustomerIdPropertyrecordsBody();
                    $body->setPropertyRecord($new_property);
                    $this->postSubCustomerProperties($body, $customer_id, $accept_language);
                }
            }
        }//source record was not found, do creation
        else {
            $customer_source = new CustomerSourceRecord();
            $customer_source->setCustomerSourceId($customer_source_id);
            $customer_source->setExternalId($external_id);

            $customers_body->setCustomerSource($customer_source);

            //post customer and get its id
            $post_customer = $this->postCustomer($customers_body, $accept_language);
            $customer_id = $post_customer->getData()->getCustomerId();

            //get newly created customer by its id
            $get_customer = $this->getCustomer($customer_id, $accept_language);
            $customer_record = $get_customer->getData();
        }

        return $customer_record;
    }
}