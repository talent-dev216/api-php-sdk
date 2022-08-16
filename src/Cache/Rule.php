<?php

namespace CrmCareCloud\Webservice\RestApi\Client\SDK\Cache;

class Rule
{
    private string $request_type;

    private string $path;

    private int $ttl;

    const REQUEST_TYPE_GET = 'GET';
    const REQUEST_TYPE_POST = 'POST';
    const REQUEST_TYPE_PUT = 'PUT';
    const REQUEST_TYPE_DELETE = 'DELETE';

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
     * @param string $requestType
     *
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
     * @param string $path
     *
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
     * @param int $ttl
     *
     * @return Rule
     */
    public function setTtl(int $ttl): Rule
    {
        $this->ttl = $ttl;

        return $this;
    }
}