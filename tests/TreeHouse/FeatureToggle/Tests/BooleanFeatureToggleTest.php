<?php

namespace TreeHouse\FeatureToggle\Tests;

use PHPUnit_Framework_TestCase;
use TreeHouse\FeatureToggle\BooleanFeatureToggle;

class BooleanFeatureToggleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider provider
     */
    public function it_toggles($input, $expected)
    {
        $toggle = new BooleanFeatureToggle($input);

        $this->assertEquals($expected, $toggle->isEnabled([]));
    }

    public function provider()
    {
        return [
            [true, true],
            [false, false],
            [0, false],
            [1, true],
            ['yes', true],
            ['no', true],
            ['', false],
        ];
    }
}
