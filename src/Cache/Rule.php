<?php

namespace CrmCareCloud\Webservice\RestApi\Client\SDK\Cache;

class Rule
{
    private string $request_type;

    private string $path;

    private int $ttl;

    public const REQUEST_TYPE_GET = 'GET';
    public const REQUEST_TYPE_POST = 'POST';
    public const REQUEST_TYPE_PUT = 'PUT';
    public const REQUEST_TYPE_DELETE = 'DELETE';

    public function __construct(string $request_type, string $path, int $ttl = 500)
    {
        $this->request_type = $request_type;
        $this->path = $path;
        $this->ttl = $ttl;
    }

    /**
     * @return string
     */
    public function getRequestType(): string
    {
        return $this->request_type;
    }

    /**
     * @return Rule
     */
    public function setRequestType(string $request_type): Rule
    {
        $this->request_type = $request_type;

        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return Rule
     */
    public function setPath(string $path): Rule
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return int
     */
    public function getTtl(): int
    {
        return $this->ttl;
    }

    /**
     * @return Rule
     */
    public function setTtl(int $ttl): Rule
    {
        $this->ttl = $ttl;

        return $this;
    }
}