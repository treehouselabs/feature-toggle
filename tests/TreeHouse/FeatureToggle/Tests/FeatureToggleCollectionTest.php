<?php

namespace TreeHouse\FeatureToggle\Tests;

use PHPUnit_Framework_TestCase;
use Prophecy\Argument;
use TreeHouse\FeatureToggle\ContextProviderInterface;
use TreeHouse\FeatureToggle\FeatureToggleCollection;
use TreeHouse\FeatureToggle\FeatureToggleInterface;

class FeatureToggleCollectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_registers_toggles()
    {
        $toggle = $this->prophesize(FeatureToggleInterface::class);
        $toggle->isEnabled([])->willReturn(true);
        $toggle->configureOptions(Argument::any())->shouldBeCalled();

        $collection = new FeatureToggleCollection();
        $collection->registerToggle('some-toggle', $toggle->reveal());

        $this->assertEquals(true, $collection->isEnabled('some-toggle'));
    }

    /**
     * @test
     */
    public function it_accepts_context_providers()
    {
        $toggle = $this->prophesize(FeatureToggleInterface::class);
        $toggle->isEnabled([])->willReturn(true);
        $toggle->configureOptions(Argument::any())->shouldBeCalled();

        $provider = $this->prophesize(ContextProviderInterface::class);
        $provider->configureOptions(Argument::any())->shouldBeCalled();

        $collection = new FeatureToggleCollection([$provider->reveal()]);
        $collection->registerToggle('some-toggle', $toggle->reveal());

        $this->assertEquals(true, $collection->isEnabled('some-toggle'));
    }

    /**
     * @test
     */
    public function it_returns_false_on_missing_required_context_option()
    {
        $toggle = new DummyFeatureToggle(true, ['some-required-option']);

        $provider = $this->prophesize(ContextProviderInterface::class);
        $provider->configureOptions(Argument::any())->shouldBeCalled();

        $collection = new FeatureToggleCollection([$provider->reveal()]);
        $collection->registerToggle('some-toggle', $toggle);

        $this->assertEquals(false, $collection->isEnabled('some-toggle'));
    }
}
