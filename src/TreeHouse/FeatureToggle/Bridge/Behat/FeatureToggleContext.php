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
     * @var bool[]
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
     *
     * @param string $name
     */
    public function theFeatureToggleIsEnabled($name)
    {
        $this->toggles[$name] = true;

        $this->updateFeatureToggleCollection($this->toggles);
    }

    /**
     * @Given /^the feature toggle "([^"]*)" is disabled$/
     *
     * @param string $name
     */
    public function theFeatureToggleIsDisabled($name)
    {
        $this->toggles[$name] = false;

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
