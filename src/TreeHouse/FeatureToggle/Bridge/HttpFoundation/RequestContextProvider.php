<?php

namespace TreeHouse\FeatureToggle\Bridge\HttpFoundation;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;
use TreeHouse\FeatureToggle\ContextProviderInterface;

class RequestContextProvider implements ContextProviderInterface
{
    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        // check if we have a request (could also be called from cli)
        if (!$this->requestStack->getMasterRequest()) {
            return;
        }

        $resolver->setDefault('client_ip', $this->requestStack->getMasterRequest()->getClientIp());
        $resolver->setDefault('uri', $this->requestStack->getMasterRequest()->getUri());
        $resolver->setDefault('request_uri', $this->requestStack->getMasterRequest()->getRequestUri());
    }
}
