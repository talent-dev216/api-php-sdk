<?php

namespace CrmCareCloud\Webservice\RestApi\Client\SDK\Data;

class AuthTypes
{
    const BASIC_AUTH = 'basicAuth';
    const BEARER_AUTH = 'Bearer';
    const DEFAULT_AUTH = self::BEARER_AUTH;
}