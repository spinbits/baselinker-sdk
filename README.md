# Spinbits.io Baselinker Sdk

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]

## Description

This package is implementation of communication with BaseLinker Connector ("integration file"). For further details please refer to https://connectors.baselinker.com/exec/docs/index.php . 

This package provides only core action handler. It's ready to be extended with your own ecommerce (Sylius, or other php-based products) action handlers.

For integration with Sylius, please go to https://github.com/spinbits/sylius-baselinker-plugin

## Install

Via Composer

``` bash
$ composer require spinbits/baselinker-sdk
```

## Usage

In order to use this package, instantiate your Baselinker handler:

``` php
$baselinkerPassword = 'secret-password';
$baselinkerHandler = new Spinbits\BaselinkerSdk\RequestHandler($baselinkerPassword);
```

Register example handlers with $actionName from BaseLinker API:
``` php
$fileVersionHandler = new Spinbits\BaselinkerSdk\Handler\Common\FileVersionActionHandler();
$baselinkerHandler->registerHandler('FileVersion', $fileVersionHandler);
```

You can register handler with some depending parameter also:
``` php
$supportedMethods = new Spinbits\BaselinkerSdk\Handler\Common\SupportedMethodsActionHandler($baselinkerHandler);
$baselinkerHandler->registerHandler('SupportedMethodsActionHandler', $supportedMethods);
```

Before your handle request you should create `Input` object which receives array passed in POST request as a parameter.
Let's assumer that $request is for example `Symfony\Component\HttpFoundation\Request` object. We can use:
``` php
$input = new Spinbits\BaselinkerSdk\Rest\Input($request->request->all());
```

In order to process incoming request you can just run:
``` php
$response = $baselinkerHandler->handle($input);
```

The result to return controller response is:
``` php
$response->getContent();
/* returns example response:
[
    'platform' => "Common spinbits baslinker plugin",
    'version' => "4.0.0",
    'standard' => 4,
]
*/
```

Example handlers, common for all implementations can be found in `src\Handler\Common`.


## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email office@spinbits.io instead of using the issue tracker.

## Credits

- [Marcin Hubert][link-author]
- [Jakub Lech][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/spinbits/baselinker-sdk.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/spinbits/baselinker-sdk/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/spinbits/baselinker-sdk.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/spinbits/baselinker-sdk.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/spinbits/baselinker-sdk.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/spinbits/baselinker-sdk
[link-travis]: https://travis-ci.org/spinbits/baselinker-sdk
[link-scrutinizer]: https://scrutinizer-ci.com/g/spinbits/baselinker-sdk/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/spinbits/baselinker-sdk
[link-downloads]: https://packagist.org/packages/spinbits/baselinker-sdk
[link-author]: https://github.com/spinbits
[link-contributors]: ../../contributors
