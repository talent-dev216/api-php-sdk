<?php

namespace CrmCareCloud\Webservice\RestApi\Client\SDK\Cache;

use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Cache\Psr16Cache;

class Cache extends Psr16Cache
{
    /** @var CacheItemPoolInterface */
    private CacheItemPoolInterface $cache_item_pool;

    /** @var Rule[] $rules */
    private array $rules;

    /**
     * @param CacheItemPoolInterface $cache_item_pool
     * @param Rule[] $rules
     */
    public function __construct(CacheItemPoolInterface $cache_item_pool, array $rules = [])
    {
        $this->cache_item_pool = $cache_item_pool;
        $this->rules = $rules;

        parent::__construct($cache_item_pool);
    }

    /**
     * @return CacheItemPoolInterface
     */
    public function getCacheItemPool(): CacheItemPoolInterface
    {
        return $this->cache_item_pool;
    }

    /**
     * @return Rule[]
     */
    public function getRules(): array
    {
        return $this->rules;
    }
}
