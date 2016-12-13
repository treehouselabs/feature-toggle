<?php

namespace TreeHouse\FeatureToggle\Bridge\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class RegisterFeatureTogglesCompilerPass implements CompilerPassInterface
{
    /**
     * @var string
     */
    protected $toggleCollectionServiceId;

    /**
     * @var string
     */
    private $tagName;

    /**
     * @param string $toggleCollectionServiceId
     * @param string $tagName
     */
    public function __construct($toggleCollectionServiceId, $tagName = 'feature_toggle')
    {
        $this->toggleCollectionServiceId = $toggleCollectionServiceId;
        $this->tagName = $tagName;
    }

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $serviceDefinition = $container->getDefinition($this->toggleCollectionServiceId);

        foreach ($container->findTaggedServiceIds($this->tagName) as $service => $tags) {
            foreach ($tags as $attributes) {
                $serviceDefinition->addMethodCall(
                    'registerToggle',
                    [$attributes['alias'], new Reference($service)]
                );
            }
        }
    }
}
