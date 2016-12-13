<?php

namespace TreeHouse\FeatureToggle;

use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FeatureToggleCollection implements FeatureToggleCollectionInterface
{
    /**
     * @var array
     */
    protected $toggles = [];

    /**
     * @var ContextProviderInterface[]
     */
    protected $contextProviders = [];

    /**
     * @param ContextProviderInterface[] $contextProviders
     */
    public function __construct(array $contextProviders = [])
    {
        $this->contextProviders = $contextProviders;
    }

    /**
     * @param string                 $name
     * @param FeatureToggleInterface $toggle
     */
    public function registerToggle($name, FeatureToggleInterface $toggle)
    {
        $resolver = new OptionsResolver();

        $this->toggles[$name] = [$toggle, $resolver];
    }

    /**
     * @param string $name
     * @param array  $context
     *
     * @return bool
     */
    public function isEnabled($name, array $context = [])
    {
        /** @var FeatureToggleInterface $toggle */
        /** @var OptionsResolver $resolver */
        list($toggle, $resolver) = $this->get($name);

        // TODO only configure options once
        {
            foreach ($this->contextProviders as $provider) {
                $provider->configureOptions($resolver);
            }

            $toggle->configureOptions($resolver);
        }

        try {
            return $toggle->isEnabled($resolver->resolve($context));
        } catch (MissingOptionsException $e) {
            return false;
        }
    }

    /**
     * @param string $name
     *
     * @return array
     */
    private function get($name)
    {
        if (isset($this->toggles[$name])) {
            return $this->toggles[$name];
        }

        return [new BooleanFeatureToggle(true), new OptionsResolver()];
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function has($name)
    {
        return isset($this->toggles[$name]);
    }
}
