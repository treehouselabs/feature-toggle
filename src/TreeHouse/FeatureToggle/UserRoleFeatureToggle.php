<?php

namespace TreeHouse\FeatureToggle;

use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRoleFeatureToggle implements FeatureToggleInterface
{
    /**
     * @var string
     */
    private $role;

    /**
     * @param string $role
     */
    public function __construct($role)
    {
        $this->role = strtoupper($role);
    }

    /**
     * @param array $context
     *
     * @return bool
     */
    public function isEnabled(array $context)
    {
        return in_array($this->role, $context['user_roles'], true);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('user_roles');
    }
}
