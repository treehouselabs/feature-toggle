<?php

namespace TreeHouse\FeatureToggle;

interface FeatureToggleCollectionInterface
{
    /**
     * @param string                 $name
     * @param FeatureToggleInterface $toggle
     */
    public function registerToggle($name, FeatureToggleInterface $toggle);

    /**
     * @param string $name
     * @param array  $context
     *
     * @return bool
     */
    public function isEnabled($name, array $context = []);

    /**
     * @param string $name
     *
     * @return bool
     */
    public function has($name);
}
