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
