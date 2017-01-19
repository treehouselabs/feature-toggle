<?php

/**
 * To make use of this toggle function shortcut, append path to this file in your composer.json
 * ie:
 * {
 *  "autoload": {
 *    "files": ["vendor/treehouselabs/feature-toggle/src/TreeHouse/FeatureToggle/Bridge/HttpKernel/functions.php"]
 *  }
 * }
 */

namespace TreeHouse\FeatureToggle\Bridge\HttpKernel;

use TreeHouse\FeatureToggle\FeatureToggleCollectionInterface;

/**
 * To make use of
 *
 * @param string $name
 *
 * @return bool
 */
function toggle($name)
{
    global $kernel;

    if (!$kernel) {
        throw new \RuntimeException('No kernel found, are you in a Symfony environment?');
    }

    /** @var FeatureToggleCollectionInterface $toggles */
    $toggles = $kernel->getContainer()->get(ToggleFunctionConfig::getServiceId());

    return $toggles->isEnabled($name);
}
