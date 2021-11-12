<?php

namespace CrmCareCloud\Webservice\RestApi\SDK\Extensions;

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\Card;
use CrmCareCloud\Webservice\RestApi\Client\Model\CardsCardIdBody;
use Exception;

class CardsApi extends \CrmCareCloud\Webservice\RestApi\Client\Api\CardsApi {

    /**
     * Search for the card and verify that it is not assigned
     *
     * @param string $card_number
     * @param string|null $accept_language
     *
     * @return Card
     * @throws ApiException
     */
	public function getUnassignedCard( string $card_number, string $accept_language = null ): Card {
		$getCard = $this->getCards( $accept_language, null, null, null, null, null, $card_number );
		$card    = $getCard->getData()->getCards()[0];

		if ( $card->getCustomerId() ) {
			throw new Exception( 'The card is already assigned to the customer.' );
		} elseif ( $card->getState() === 0 ) {
			throw new Exception( 'The card is blocked.' );
		} else {
			return $card;
		}
	}

    /**
     * Assigning a free card to a customer
     *
     * @param string $card_number
     * @param string $customer_id
     * @param string|null $valid_from
     * @param string|null $valid_to
     * @param string|null $store_id
     * @param string|null $accept_language
     *
     * @return void
     * @throws ApiException
     */
	public function putUnassignedCard( string $card_number, string $customer_id, string $valid_from = null, string $valid_to = null, string $store_id = null, string $accept_language = null ) {
		$unassignedCard = $this->getUnassignedCard( $card_number, $accept_language );

		$cartBody = new Card();
		$cartBody->setCustomerId( $customer_id )
		         ->setCardTypeId( $unassignedCard->getCardId() )
		         ->setCardNumber( $card_number )
		         ->setValidFrom( $valid_from )
		         ->setValidTo( $valid_to )
		         ->setStoreId( $store_id )
		         ->setState( $unassignedCard->getState() );

		$body = new CardsCardIdBody();
		$body->setCard( $cartBody );

		$this->putCard( $body, $unassignedCard->getCardId(), );
	}
}