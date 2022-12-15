<?php

namespace CrmCareCloud\Webservice\RestApi\Client\SDK\Extensions;

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Configuration;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsAssignfreecardBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\Card;
use CrmCareCloud\Webservice\RestApi\Client\Model\CardsCardIdBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\Customer;
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
     * @param Configuration   $config
     * @param CareCloud       $careCloud
     */
    public function __construct(ClientInterface $client, Configuration $config, CareCloud $care_cloud)
    {
        parent::__construct($client, $config);
        $this->care_cloud = $care_cloud;
    }

    /**
     * Get all rewards
     *
     * @param string      $customer_id
     * @param bool        $rewards
     * @param int|null    $reward_group
     * @param bool        $vouchers
     * @param bool        $campaign_products
     * @param bool|null   $is_valid
     * @param string|null $customer_type_id
     * @param string|null $accept_language
     *
     * @return array[]
     * @throws ApiException
     */
    public function getAllRewards(string $customer_id, bool $rewards = true, int $reward_group = null, bool $vouchers = true, bool $campaign_products = true, bool $is_valid = null, string $customer_type_id = null, string $accept_language = null): array
    {

        $rewards_data = [];
        $total_rewards = 0;
        $vouchers_data = [];
        $total_vouchers = 0;
        $campaign_products_data = [];
        $total_campaign_products = 0;

        // We want get resource rewards
        if($rewards)
        {
            $get_rewards = $this->getSubCustomerRewards($customer_id, $accept_language, null, null, null, null, null, null, $is_valid, null, null, null, null, $reward_group, $customer_type_id);
            $rewards_data = $get_rewards->getData()->getRewards();
            $total_rewards = $get_rewards->getData()->getTotalItems();
        }

        // We want get resource vouchers
        if($vouchers)
        {
            $get_vouchers = $this->getSubCustomerVouchers($customer_id, $accept_language, null, null, null, null, null, $is_valid);
            $vouchers_data = $get_vouchers->getData()->getVouchers();
            $total_vouchers = $get_vouchers->getData()->getTotalItems();
        }

        // We want get resource campaign-products
        if($campaign_products)
        {
            $get_campaign_products = $this->care_cloud->campaignProductsApi()->getCampaignProducts($accept_language, null, null, null, null, null, null, null, $customer_type_id);
            $campaign_products_data = $get_campaign_products->getData()->getCampaignProducts();
            $total_campaign_products = $get_campaign_products->getData()->getTotalItems();
        }

        return [
            'rewards' => [
                'items'       => array_merge($rewards_data, $vouchers_data, $campaign_products_data),
                'total_items' => $total_rewards + $total_vouchers + $total_campaign_products,
            ],
        ];
    }

    /**
     * Save the customer extended
     *
     * @param             $customerBody
     * @param Card|null   $card
     * @param null        $propertyBody
     * @param null        $interestBody
     * @param string|null $accept_language
     *
     * @return array<string, string|null>
     * @throws ApiException
     * @throws Exception
     */
    public function postCustomerExtended($customer_body, ?Card $card = null, $property_body = null, $interest_body = null, string $accept_language = null): array
    {
        // Card data
        $card_id = null;
        $state = $card ?? $card->getState();
        $card_number = $card ?? $card->getCardNumber();
        $valid_from = $card ?? $card->getValidFrom();
        $valid_to = $card ?? $card->getValidTo();
        $store_id = $card ?? $card->getStoreId();
        $card_type_id = $card ?? $card->getCardTypeId();

        $response = array(
            'customer_id'        => null,
            'card_id'            => null,
            'property_record_id' => null,
            'interest_record_id' => null,
        );

        // Search for the card and verify that it is not assigned
        if($card_number)
        {
            $unassigned_card = $this->care_cloud->cardsApi()->getUnassignedCard($card_number);
            $card_id = $unassigned_card->getCardId();
            $state = $unassigned_card->getState();
            $card_type_id = $unassigned_card->getCardTypeId();
        }

        // Create a new customer
        $new_customer = $this->postCustomer($customer_body, $accept_language);
        $customer_id = $new_customer->getData()->getCustomerId();
        $response['customer_id'] = $customer_id;

        //assign the customer's searched card if it is free
        if($card_number && $card_id)
        {
            $cart_body = new Card();
            $cart_body->setCustomerId($customer_id)
                ->setCardTypeId($card_type_id)
                ->setCardNumber($card_number)
                ->setValidFrom($valid_from)
                ->setValidTo($valid_to)
                ->setStoreId($store_id)
                ->setState($state);

            $body = new CardsCardIdBody();
            $body->setCard($cart_body);

            $this->care_cloud->cardsApi()->putCard($body, $card_id, $accept_language);
            // If we don't know the card number assign any free
        }
        else
        {
            if(!$card_type_id)
            {
                throw new Exception('To assign a free card you need to fill cardTypeId');
            }

            $body = new ActionsAssignfreecardBody();
            $body->setCardTypeId($card_type_id)
                ->setCustomerId($customer_id);

            $free_card = $this->care_cloud->cardsApi()->postAssignCard($body, $accept_language);
            $card_id = $free_card->getData()->getCardId();
        }

        $response['card_id'] = $card_id;

        // Add a property to a customer if is set
        if($property_body)
        {
            $property_record = $this->postSubCustomerProperties($property_body, $customer_id, $accept_language);
            $property_record_id = $property_record->getData()->getPropertyRecordId();
            $response['property_record_id'] = $property_record_id;
        }

        // Add an interest record to a customer if is set
        if($interest_body)
        {
            $interest_record = $this->postSubCustomerInterest($interest_body, $customer_id, $accept_language);
            $interest_record_id = $interest_record->getData()->getInterestRecordId();
            $response['interest_record_id'] = $interest_record_id;
        }

        return $response;
    }

    /**
     * @param CareCloud     $care_cloud
     * @param CustomersBody $customers_body
     * @param string        $accept_language
     * @param string        $customer_source_id
     * @param string        $external_id
     *
     * @return Customer|void
     */
    public function synchronizeCustomer(CareCloud $care_cloud, CustomersBody $customers_body, string $accept_language, string $customer_source_id, string $external_id)
    {
        //search source record by $external_id & $customer_source_id
        try
        {
            $get_source_record = $care_cloud->customerSourceRecordsApi()->getCustomerSourceRecords(
                $accept_language,
                null,
                null,
                null,
                null,
                null,
                $external_id,
                $customer_source_id
            );
            $source_record = $get_source_record->getData()->getCustomerSourceRecords();
        }
        catch(ApiException $e)
        {
            die(var_dump($e->getResponseBody() ?: $e->getMessage()));
        }
        //source record was found, do updating
        if(count($source_record) > 0)
        {
            $body = new CustomersCustomerIdBody();
            $body->setCustomer($customers_body->getCustomer())
                ->setPassword($customers_body->getPassword())
                ->setSocialNetworkCredentials($customers_body->getSocialNetworkCredentials());

            try
            {
                //update customer
                $customer_id = $source_record['0']['customer_id'];
                $this->putCustomer($body, $customer_id, $accept_language);

                //get updated customer by its id
                $get_customer = $this->getCustomer($customer_id, $accept_language);
                $customer_record = $get_customer->getData();

                //if we have customer's property records passed, we have to delete existing and add those that were passed
                $get_property_records = $this->getSubCustomerProperties($customer_id, $accept_language);
                $property_records = $get_property_records->getData()->getPropertyRecords();
                $total_items = $get_property_records->getData()->getTotalItems();

                //deleting existing properties if there are any
                if($total_items > 0)
                {
                    foreach($property_records as $property_record)
                    {
                        //if there is property value
                        if($property_record->getPropertyValue())
                        {
                            $this->deleteSubCustomerProperty($customer_id, $property_record->getPropertyRecordId(), $accept_language);
                        }
                    }
                }

                //adding new properties if there are any
                if($customers_body->getPropertyRecords())
                {
                    foreach($customers_body->getPropertyRecords() as $property_record)
                    {
                        $body = new CustomerIdPropertyrecordsBody();
                        $body->setPropertyRecord($property_record);
                        $this->postSubCustomerProperties($body, $customer_id, $accept_language);
                    }
                }
            }
            catch(ApiException $e)
            {
                die(var_dump($e->getResponseBody() ?: $e->getMessage()));
            }
        }//source record was not found, do creation
        else
        {
            $customer_source = new CustomerSourceRecord();
            $customer_source->setCustomerSourceId($customer_source_id);
            $customer_source->setExternalId($external_id);

            $customers_body->setCustomerSource($customer_source);

            try
            {
                //post customer and get its id
                $post_customer = $this->postCustomer($customers_body, $accept_language);
                $customer_id = $post_customer->getData()->getCustomerId();

                //get newly created customer by its id
                $get_customer = $this->getCustomer($customer_id, $accept_language);
                $customer_record = $get_customer->getData();
            }
            catch(ApiException $e)
            {
                die(var_dump($e->getResponseBody() ?: $e->getMessage()));
            }
        }

        return $customer_record;
    }
}