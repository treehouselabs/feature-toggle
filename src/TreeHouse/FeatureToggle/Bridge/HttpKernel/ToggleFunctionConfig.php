<?php
declare(strict_types = 1);

namespace TreeHouse\FeatureToggle\Bridge\HttpKernel;

abstract class ToggleFunctionConfig
{
    /**
     * @var string
     */
    private static $serviceId = 'feature_toggles.collection';

    /**
     * @param string $name
     */
    public static function setServiceId($name)
    {
        self::$serviceId = $name;
    }

    /**
     * @return string
     */
    public static function getServiceId()
    {
        return self::$serviceId;
    }
}
