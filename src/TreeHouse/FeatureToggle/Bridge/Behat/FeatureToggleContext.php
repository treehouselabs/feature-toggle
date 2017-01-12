<?php

namespace TreeHouse\FeatureToggle\Bridge\Behat;

use Behat\Behat\Context\Context;
use Psr\Cache\CacheItemPoolInterface;

class FeatureToggleContext implements Context
{
    /**
     * @var CacheItemPoolInterface
     */
    protected $cacheItemPool;

    /**
     * @var array
     */
    protected $toggles = [];

    /**
     * @param CacheItemPoolInterface $cacheItemPool
     */
    public function __construct(CacheItemPoolInterface $cacheItemPool)
    {
        $this->cacheItemPool = $cacheItemPool;
    }

    /**
     * @Given /^the feature toggle "([^"]*)" is enabled$/
     */
    public function theFeatureToggleIsEnabled($name)
    {
        $this->toggles[] = $name;

        $this->updateFeatureToggleCollection($this->toggles);
    }

    /**
     * @Given /^the feature toggle "([^"]*)" is disabled$/
     */
    public function theFeatureToggleIsDisabled($name)
    {
        $this->toggles = array_diff($this->toggles, [$name]);

        $this->updateFeatureToggleCollection($this->toggles);
    }

    /**
     * @param array $toggles
     */
    protected function updateFeatureToggleCollection(array $toggles)
    {
        $item = $this->cacheItemPool->getItem('feature-toggles');

        $item->set($toggles);

        $this->cacheItemPool->save($item);
    }
}
