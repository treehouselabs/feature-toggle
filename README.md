# Feature Toggle

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]

Simple feature toggle library

## Installation

```sh
composer require treehouselabs/feature-toggle
```


## Usage


### Simple 

```php
$features = new FeatureToggleCollection();
$features->registerToggle(
    'feature-x',
    new BooleanFeatureToggle(true)
);

if ($features->isEnabled('feature-x')) {
    // perform stuff for feature-x
}

```

### Symfony application

In app/config/services.yml add

```yaml
services:
  feature_toggles.collection:
    class: TreeHouse\FeatureToggle\FeatureToggleCollection
  
  feature_toggles.toggle.dont_allow:
    class: TreeHouse\FeatureToggle\BooleanFeatureToggle
    arguments: [false]
    tags:
      - { name: feature_toggle, alias: 'feature-x' }
      
  app.twig_extension.feature_toggle:
     class: TreeHouse\FeatureToggle\Bridge\Twig\FeatureToggleExtension
     arguments:
       - '@feature_toggles.collection'
     tags:
       - { name: twig.extension }   
```

In composer.json autoload the shortcut function (so you don't have to inject the FeatureCollection everywhere)

```json
{
  "autoload": {
    "files": ["vendor/treehouselabs/feature-toggle/src/TreeHouse/FeatureToggle/Bridge/HttpKernel/functions.php"]
  }
}
```

Register compiler pass in your AppBunde.php

```php
use TreeHouse\FeatureToggle\Bridge\DependencyInjection\RegisterFeatureTogglesCompilerPass;

class AppBundle extends Bundle
{
    ...
    public function build(ContainerBuilder $container)
    {
        ...
        $container->addCompilerPass(new RegisterFeatureTogglesCompilerPass('feature_toggles.collection'));
        ...
    }
    ...
}
```

Check feature from any php file in your symfony project:

```php
if (\TreeHouse\FeatureToggle\Bridge\HttpKernel\toggle('feature-x')) {
    // perform stuff for feature-x
}
```

Or in your twig templates with:

```twig
{% if toggle('feature-x') %}
  Do stuff
{% endif %}
```

### Behat context

```yaml
# behat.yml

default:
  suites:
    default:
        contexts:
          - TreeHouse\FeatureToggle\Bridge\Behat\FeatureToggleContext:
              cacheItemPool: '@cache_item_pool' #PSR-6 cache item pool
```

```php
<?php
   class Feature
   {
       private $features;

       public function __construct(FeatureToggleCollectionInterface $features) {
           $this->features = $features;
       }

       public function indexAction()
       {
           if ($this->features->isEnabled('feature-y')) {
               return 'Enabled!';
           }

           return 'Disabled!';
       }
   }

   $toggleCollection = new CacheFeatureToggleCollection();
   $toggleCollection->setCacheItemPool($psr6CacheItemPool);

   // Overwrite the FeatureToggleCollection with the CacheFeatureToggleCollection in test env
   new Feature($toggleCollection);
```

```yaml
# feature-y.feature

Feature: Feature-Y

  Scenario: Feature-Y is enabled
    Given the feature toggle "feature-y" is enabled
    And I am on the homepage
    Then I should see "Enabled!"

  Scenario: Feature-Y is disabled
#   Given the feature toggle "feature-y" is disabled (default)
    Given I am on the homepage
    Then I should see "Disabled!"
```


## Testing

``` bash
composer test
```


## Security

If you discover any security related issues, please email dev@treehouse.nl instead of using the issue tracker.


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


## Credits

- [Mark van Duijker][link-author-mark]
- [Jeroen Fiege][link-author-jeroen]
- [All Contributors][link-contributors]


[ico-version]: https://img.shields.io/packagist/v/treehouselabs/feature-toggle.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/treehouselabs/feature-toggle/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/treehouselabs/feature-toggle.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/treehouselabs/feature-toggle.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/treehouselabs/feature-toggle.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/treehouselabs/feature-toggle
[link-travis]: https://travis-ci.org/treehouselabs/feature-toggle
[link-scrutinizer]: https://scrutinizer-ci.com/g/treehouselabs/feature-toggle/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/treehouselabs/feature-toggle
[link-downloads]: https://packagist.org/packages/treehouselabs/feature-toggle
[link-author-mark]: https://github.com/mvanduijker
[link-author-jeroen]: https://github.com/fieg
[link-contributors]: ../../contributors
