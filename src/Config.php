<?php

namespace CrmCareCloud\Webservice\RestApi\SDK;

use CrmCareCloud\Webservice\RestApi\SDK\Data\AuthTypes;
use CrmCareCloud\Webservice\RestApi\SDK\Data\Interfaces;
use Symfony\Contracts\Cache\CacheInterface;

class Config {

	private string $projectUri;
	private string $login;
	private string $password;
	private string $externalAppId;
	private string $authType;
	private ?CacheInterface $cache;
	private ?string $token;
	private array $middlewares;
	private string $interface;

	public function __construct(
		string $projectUri,
		string $login,
		string $password,
		string $externalAppId = '',
		string $authType = AuthTypes::BASIC_AUTH,
		string $interface = Interfaces::ENTERPRISE,
		CacheInterface $cache = null,
		string $token = null,
		array $middlewares = []
	) {
		$this->projectUri    = $projectUri;
		$this->login         = $login;
		$this->password      = $password;
		$this->externalAppId = $externalAppId;
		$this->authType      = $authType;
		$this->cache         = $cache;
		$this->token         = $token;
		$this->middlewares   = $middlewares;
		$this->interface = $interface;
	}

	/**
	 * @return string
	 */
	public function getProjectUri(): string {
		return $this->projectUri;
	}

	/**
	 * @param string $projectUri
	 *
	 * @return Config
	 */
	public function setProjectUri( string $projectUri ): Config {
		$this->projectUri = $projectUri;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLogin(): string {
		return $this->login;
	}

	/**
	 * @param string $login
	 *
	 * @return Config
	 */
	public function setLogin( string $login ): Config {
		$this->login = $login;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPassword(): string {
		return $this->password;
	}

	/**
	 * @param string $password
	 *
	 * @return Config
	 */
	public function setPassword( string $password ): Config {
		$this->password = $password;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getExternalAppId(): string {
		return $this->externalAppId;
	}

	/**
	 * @param string $externalAppId
	 *
	 * @return Config
	 */
	public function setExternalAppId( string $externalAppId ): Config {
		$this->externalAppId = $externalAppId;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getAuthType(): string {
		return $this->authType;
	}

	/**
	 * @param string $authType
	 *
	 * @return Config
	 */
	public function setAuthType( string $authType ): Config {
		$this->authType = $authType;

		return $this;
	}

	/**
	 * @return CacheInterface|null
	 */
	public function getCache(): ?CacheInterface {
		return $this->cache;
	}

	/**
	 * @param CacheInterface|null $cache
	 */
	public function setCache( ?CacheInterface $cache ): void {
		$this->cache = $cache;
	}

	/**
	 * @return string|null
	 */
	public function getToken(): ?string {
		return $this->token;
	}

	/**
	 * @param string|null $token
	 */
	public function setToken( ?string $token ): void {
		$this->token = $token;
	}

	/**
	 * @return array
	 */
	public function getMiddlewares(): array {
		return $this->middlewares;
	}

	/**
	 * @param array $middlewares
	 */
	public function setMiddlewares( array $middlewares ): void {
		$this->middlewares = $middlewares;
	}

	/**
	 * @return string
	 */
	public function getInterface(): string {
		return $this->interface;
	}

	/**
	 * @param string $interface
	 */
	public function setInterface( string $interface ): void {
		$this->interface = $interface;
	}

}
