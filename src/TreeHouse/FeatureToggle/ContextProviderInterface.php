<?php

namespace TreeHouse\FeatureToggle;

use Symfony\Component\OptionsResolver\OptionsResolver;

interface ContextProviderInterface
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver);
}
