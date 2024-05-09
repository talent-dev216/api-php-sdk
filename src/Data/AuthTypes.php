<?php

namespace CrmCareCloud\Webservice\RestApi\Client\SDK\Data;

class AuthTypes
{
    public const BASIC_AUTH = 'basicAuth';
    public const BEARER_AUTH = 'Bearer';
    public const DEFAULT_AUTH = self::BEARER_AUTH;
}