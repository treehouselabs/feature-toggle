<?php

namespace TreeHouse\FeatureToggle\Tests;

use PHPUnit_Framework_TestCase;
use TreeHouse\FeatureToggle\WhitelistedIpFeatureToggle;

class WhitelistedIpFeatureToggleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_checks_against_whitelist_ip()
    {
        $toggle = new WhitelistedIpFeatureToggle(
            ['127.0.0.1']
        );

        $this->assertEquals(true, $toggle->isEnabled(['client_ip' => '127.0.0.1']));
        $this->assertEquals(false, $toggle->isEnabled(['client_ip' => '192.168.1.1']));
    }

    /**
     * @test
     */
    public function it_checks_against_whitelist_ip_range()
    {
        $toggle = new WhitelistedIpFeatureToggle(
            ['192.168.0.0/24']
        );

        $this->assertEquals(true, $toggle->isEnabled(['client_ip' => '192.168.0.1']));
        $this->assertEquals(false, $toggle->isEnabled(['client_ip' => '192.168.1.1']));
    }
}
