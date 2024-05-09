<?php

namespace CrmCareCloud\Webservice\RestApi\Client\SDK\Cache;

use Kevinrob\GuzzleCache\Strategy\Delegate\RequestMatcherInterface;
use Psr\Http\Message\RequestInterface;

class CacheRequestMatcher implements RequestMatcherInterface
{
    private Rule $rule;

    public function __construct(Rule $rule)
    {
        $this->rule = $rule;
    }

    /**
     * @inheritDoc
     */
    public function matches(RequestInterface $request)
    {
        if ($this->rule->getRequestType() !== $request->getMethod()) {
            return false;
        }

        if (!str_contains($request->getUri()->getPath(), $this->rule->getPath())) {
            return false;
        }

        return true;
    }
}