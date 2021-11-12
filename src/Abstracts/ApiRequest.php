<?php

namespace CrmCareCloud\Webservice\RestApi\SDK\Abstracts;

use RelayPay\Api\ECommerceApi;
use CrmCareCloud\Webservice\RestApi\SDK\Config;
use CrmCareCloud\Webservice\RestApi\SDK\Client;
use CrmCareCloud\Webservice\RestApi\SDK\Exceptions\ApiException;

abstract class ApiRequest {
	private $client;
	private Config $config;
	const API_VERSION = 1;

	public function __construct( Config $apiKeys, $client ) {
		$this->client      = $client;
		$this->config = $apiKeys;
	}

	/**
	 * @return ECommerceApi
	 */
	public function getClient() {
		return $this->client;
	}

	/**
	 * @return Config
	 */
	public function getConfig(): Config {
		return $this->config;
	}

	public function getRequestUrl( $endpoint ) {
		return 'api/v' . $this::API_VERSION . '/' . $endpoint;
	}

	public function generateSignature(  string $data = '' ) {
		return hash( 'sha256',  $data . $this->getConfig()->getPrivateKey() );
	}

	public function validateSignature( $data, $signature ) {
		return $this->generateSignature( $data ) === $signature;
	}
}