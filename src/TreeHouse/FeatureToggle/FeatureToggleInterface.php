<?php

namespace TreeHouse\FeatureToggle;

use Symfony\Component\OptionsResolver\OptionsResolver;

interface FeatureToggleInterface
{
    /**
     * @param array $context
     *
     * @return bool
     */
    public function isEnabled(array $context);

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver);
}
