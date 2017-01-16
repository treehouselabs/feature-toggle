<?php

namespace TreeHouse\FeatureToggle\Bridge\Behat;

use Psr\Cache\CacheItemPoolInterface;
use TreeHouse\FeatureToggle\FeatureToggleCollection;

class SessionFeatureToggleCollection extends FeatureToggleCollection
{
    /**
     * @var CacheItemPoolInterface
     */
    protected $cacheItemPool;

    /**
     * @inheritdoc
     */
    public function isEnabled($name, array $context = [])
    {
        $item = $this->cacheItemPool->getItem('feature-toggles');

        return in_array($name, (array) $item->get()) || !parent::has($name);
    }

    /**
     * @param CacheItemPoolInterface $cacheItemPool
     */
    public function setCacheItemPool(CacheItemPoolInterface $cacheItemPool)
    {
        $this->cacheItemPool = $cacheItemPool;
    }
}
