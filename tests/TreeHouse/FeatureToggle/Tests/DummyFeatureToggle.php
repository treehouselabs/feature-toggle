<?php

namespace TreeHouse\FeatureToggle\Tests;

use Symfony\Component\OptionsResolver\OptionsResolver;
use TreeHouse\FeatureToggle\FeatureToggleInterface;

class DummyFeatureToggle implements FeatureToggleInterface
{
    /**
     * @var bool
     */
    private $isEnabled;

    /**
     * @var array
     */
    private $requiredResolverOptions;

    /**
     * @param bool  $isEnabled
     * @param array $requiredResolverOptions
     */
    public function __construct($isEnabled, array $requiredResolverOptions = [])
    {
        $this->isEnabled = $isEnabled;
        $this->requiredResolverOptions = $requiredResolverOptions;
    }

    /**
     * @param array $context
     *
     * @return bool
     */
    public function isEnabled(array $context)
    {
        return $this->isEnabled;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        foreach ($this->requiredResolverOptions as $requiredResolverOption) {
            $resolver->setRequired($requiredResolverOption);
        }
    }
}
