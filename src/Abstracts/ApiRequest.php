<?php

namespace CareCloud\SDK\Abstracts;

use RelayPay\Api\ECommerceApi;
use CareCloud\SDK\Config;
use CareCloud\SDK\Client;
use CareCloud\SDK\Exceptions\ApiException;

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