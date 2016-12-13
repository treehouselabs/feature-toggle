<?php

namespace TreeHouse\FeatureToggle\Bridge\Security;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Role\RoleInterface;
use TreeHouse\FeatureToggle\ContextProviderInterface;

class UserRolesContextProvider implements ContextProviderInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @param TokenStorageInterface $user
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $userRoles = [];

        $token = $this->tokenStorage->getToken();

        if ($token) {
            $userRoles = array_map(function (RoleInterface $role) {
                return $role->getRole();
            }, $token->getRoles());
        }

        $resolver->setDefault('user_roles', $userRoles);
    }
}
