<?php

namespace TreeHouse\FeatureToggle;

use Symfony\Component\OptionsResolver\OptionsResolver;

class BooleanFeatureToggle implements FeatureToggleInterface
{
    /**
     * @var bool
     */
    private $value;

    /**
     * @param bool $value
     */
    public function __construct($value)
    {
        $this->value = (bool) $value;
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled(array $context)
    {
        return $this->value;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    }
}
