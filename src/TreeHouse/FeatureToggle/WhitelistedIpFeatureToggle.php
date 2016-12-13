<?php

namespace TreeHouse\FeatureToggle;

use Symfony\Component\OptionsResolver\OptionsResolver;

class WhitelistedIpFeatureToggle implements FeatureToggleInterface
{
    /**
     * @var string[]
     */
    protected $whitelistedIps = [];

    /**
     * @param string[] $whitelistedIps
     */
    public function __construct(array $whitelistedIps = [])
    {
        $this->whitelistedIps = $whitelistedIps;
    }

    /**
     * @param array $context
     *
     * @return bool
     */
    public function isEnabled(array $context)
    {
        return in_array($context['client_ip'], $this->whitelistedIps, true);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('client_ip');
    }
}
