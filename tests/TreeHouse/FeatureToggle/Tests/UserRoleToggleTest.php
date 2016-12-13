<?php

namespace TreeHouse\FeatureToggle\Tests;

use TreeHouse\FeatureToggle\UserRoleFeatureToggle;

class UserRoleToggleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_checks_against_user_role()
    {
        $toggle = new UserRoleFeatureToggle(
            'SOME_ROLE'
        );

        $this->assertEquals(true, $toggle->isEnabled(['user_roles' => ['SOME_ROLE', 'SOME_OTHER_ROLE']]));
        $this->assertEquals(false, $toggle->isEnabled(['user_roles' => ['SOME_OTHER_ROLE']]));
    }
}
