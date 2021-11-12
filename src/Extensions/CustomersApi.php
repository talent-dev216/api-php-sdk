<?php

namespace CrmCareCloud\Webservice\RestApi\SDK\Extensions;

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Configuration;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsAssignfreecardBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\Card;
use CrmCareCloud\Webservice\RestApi\Client\Model\CardsCardIdBody;
use CrmCareCloud\Webservice\RestApi\SDK\CareCloud;
use Exception;
use GuzzleHttp\ClientInterface;

class CustomersApi extends \CrmCareCloud\Webservice\RestApi\Client\Api\CustomersApi {
	private CareCloud $careCloud;

	/**
	 * @param  ClientInterface  $client
	 * @param  Configuration  $config
	 * @param  CareCloud  $careCloud
	 */
	public function __construct( ClientInterface $client, Configuration $config, CareCloud $careCloud ) {
		parent::__construct( $client, $config );
		$this->careCloud = $careCloud;
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
     * @return array[]
     * @throws ApiException
     */
    public function getAllRewards( string $customer_id, bool $rewards = true, int $reward_group = null, bool $vouchers = true, bool $campaign_products = true, bool $is_valid = null, string $customer_type_id = null, string $accept_language = null ): array
    {

        $rewardsData           = [];
        $totalRewards          = 0;
        $vouchersData          = [];
        $totalVouchers         = 0;
        $campaignProductsData  = [];
        $totalCampaignProducts = 0;

		// We want get resource rewards
		if ( $rewards ) {
            $getRewards   = $this->getSubCustomerRewards( $customer_id, $accept_language, null, null, null, null, null, null, $is_valid, null, null, null, null, $reward_group,  $customer_type_id );
            $rewardsData  = $getRewards->getData()->getRewards();
            $totalRewards = $getRewards->getData()->getTotalItems();
		}

		// We want get resource vouchers
		if ( $vouchers ) {
			$getVouchers   = $this->getSubCustomerVouchers( $customer_id, $accept_language, null, null, null, null, null, $is_valid );
			$vouchersData  = $getVouchers->getData()->getVouchers();
            $totalVouchers = $getVouchers->getData()->getTotalItems();
		}

		// We want get resource campaign-products
		if ( $campaign_products ) {
			$getCampaignProducts   = $this->careCloud->campaignProductsApi()->getCampaignProducts(  $accept_language, null, null, null, null, null, null, null, $customer_type_id );
			$campaignProductsData  = $getCampaignProducts->getData()->getCampaignProducts();
            $totalCampaignProducts = $getCampaignProducts->getData()->getTotalItems();
		}

        return [
            'rewards' => [
                'items'       => array_merge($rewardsData, $vouchersData, $campaignProductsData),
                'total_items' => $totalRewards + $totalVouchers + $totalCampaignProducts,
            ],
        ];
    }

    /**
     * Save the customer extended
     *
     * @param $customerBody
     * @param Card|null $card
     * @param null $propertyBody
     * @param null $interestBody
     * @param string|null $accept_language
     *
     * @return null[]
     * @throws ApiException
     * @throws Exception
     */
	public function postCustomerExtended( $customerBody, ?Card $card = null, $propertyBody = null, $interestBody = null, string $accept_language = null ): array
    {
		// Card data
        $card_id      = null;
		$card_number  = $card ?? $card->getCardNumber();
		$valid_from   = $card ?? $card->getValidFrom();
		$valid_to     = $card ?? $card->getValidTo();
		$store_id     = $card ?? $card->getStoreId();
		$card_type_id = $card ?? $card->getCardTypeId();

		$response = array(
			'customer_id'        => null,
			'card_id'            => null,
			'property_record_id' => null,
			'interest_record_id' => null,
		);

		// Search for the card and verify that it is not assigned
		if ( $card_number ) {
			$unassignedCard = $this->careCloud->cardsApi()->getUnassignedCard( $card_number );
			$card_id        = $unassignedCard->getCardId();
			$state          = $unassignedCard->getState();
			$card_type_id   = $unassignedCard->getCardTypeId();
		}

		// Create a new customer
		$newCustomer             = $this->postCustomer( $customerBody, $accept_language );
		$customerId              = $newCustomer->getData()->getCustomerId();
		$response['customer_id'] = $customerId;

		//assign the customer's searched card if it is free
		if ( $card_number && $card_id ) {
			$cartBody = new Card();
			$cartBody->setCustomerId( $customerId )
			         ->setCardTypeId( $card_type_id )
			         ->setCardNumber( $card_number )
			         ->setValidFrom( $valid_from )
			         ->setValidTo( $valid_to)
			         ->setStoreId( $store_id )
			         ->setState( $state );

			$body = new CardsCardIdBody();
			$body->setCard( $cartBody );

			$this->careCloud->cardsApi()->putCard( $body, $card_id, $accept_language );

        // If we don't know the card number assign any free
		} else {
			if ( ! $card_type_id ) {
				throw new Exception( 'To assign a free card you need to fill cardTypeId' );
			}

			$body = new ActionsAssignfreecardBody();
			$body->setCardTypeId( $card_type_id )
			     ->setCustomerId( $customerId );

			$freeCard  = $this->careCloud->cardsApi()->postAssignCard( $body, $accept_language );
			$card_id   = $freeCard->getData()->getCardId();
		}

		$response['card_id'] = $card_id;

		// Add a property to a customer if is set
		if ( $propertyBody ) {
			$propertyRecord                 = $this->postSubCustomerProperties( $propertyBody, $customerId, $accept_language );
			$propertyRecordId               = $propertyRecord->getData()->getPropertyRecordId();
			$response['property_record_id'] = $propertyRecordId;
		}

		// Add an interest record to a customer if is set
		if ( $interestBody ) {
			$interestRecord                 = $this->postSubCustomerInterest( $interestBody, $customerId, $accept_language );
			$interestRecordId               = $interestRecord->getData()->getInterestRecordId();
			$response['interest_record_id'] = $interestRecordId;
		}

		return $response;
	}
}