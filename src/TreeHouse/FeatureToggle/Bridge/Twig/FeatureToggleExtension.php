<?php

namespace TreeHouse\FeatureToggle\Bridge\Twig;

use TreeHouse\FeatureToggle\FeatureToggleCollectionInterface;

class FeatureToggleExtension extends \Twig_Extension
{
    /**
     * @var FeatureToggleCollectionInterface
     */
    protected $toggleCollection;

    /**
     * @param FeatureToggleCollectionInterface $toggleCollection
     */
    public function __construct(FeatureToggleCollectionInterface $toggleCollection)
    {
        $this->toggleCollection = $toggleCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'toggle';
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('toggle', [&$this, 'isToggleEnabled']),
        ];
    }

    /**
     * @param string $name
     * @param array  $context
     *
     * @return bool
     */
    public function isToggleEnabled($name, array $context = [])
    {
        return $this->toggleCollection->isEnabled($name, $context);
    }
}
