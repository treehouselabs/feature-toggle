<?php

namespace TreeHouse\FeatureToggle\Bridge\Behat;

use Psr\Cache\CacheItemPoolInterface;
use TreeHouse\FeatureToggle\FeatureToggleCollection;

class CacheFeatureToggleCollection extends FeatureToggleCollection
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

        /** @var bool[] $toggles */
        $toggles = (array) $item->get();

        if (isset($toggles[$name])) {
            return $toggles[$name];
        }

        return parent::isEnabled($name);
    }

    /**
     * @param CacheItemPoolInterface $cacheItemPool
     */
    public function setCacheItemPool(CacheItemPoolInterface $cacheItemPool)
    {
        $this->cacheItemPool = $cacheItemPool;
    }
}
