<?php

namespace CareCloud\SDK\Cache;

class Rule {
	private string $requestType;
	private string $path;
	private int $ttl;

	const REQUEST_TYPE_GET = 'GET';
	const REQUEST_TYPE_POST = 'POST';
	const REQUEST_TYPE_PUT = 'PUT';
	const REQUEST_TYPE_DELETE = 'DELETE';

	public function __construct( string $requestType, string $path, int $ttl = 500 ) {
		$this->requestType = $requestType;
		$this->path        = $path;
		$this->ttl         = $ttl;
	}

	/**
	 * @return string
	 */
	public function getRequestType(): string {
		return $this->requestType;
	}

	/**
	 * @param  string  $requestType
	 *
	 * @return Rule
	 */
	public function setRequestType( string $requestType ): Rule {
		$this->requestType = $requestType;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPath(): string {
		return $this->path;
	}

	/**
	 * @param  string  $path
	 *
	 * @return Rule
	 */
	public function setPath( string $path ): Rule {
		$this->path = $path;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getTtl(): string {
		return $this->ttl;
	}

	/**
	 * @param  string  $ttl
	 *
	 * @return Rule
	 */
	public function setTtl( string $ttl ): Rule {
		$this->ttl = $ttl;

		return $this;
	}
}