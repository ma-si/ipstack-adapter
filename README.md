# Geolocation Ipstack Adapter

[![Build status][Master image]][Master]
[![Coverage Status][Master coverage image]][Master coverage]
[![Code Climate][Code Climate image]][Code Climate]
[![Packagist][Packagist image]][Packagist]

[![License][License image]][License]

## Installation

Install via composer:

```console
$ composer require --dev aist/ipstack-adapter
```

## Configuration
Add your ipstack API key to local config
```
return [
    'ipstack' => [
        'key' => '***',
    ],
];
```


  [Master image]: https://img.shields.io/travis/ma-si/ipstack-adapter/master.svg?style=flat-square
  [Master]: https://secure.travis-ci.org/ma-si/ipstack-adapter
  [Master coverage image]: https://img.shields.io/coveralls/ma-si/ipstack-adapter/master.svg?style=flat-square
  [Master coverage]: https://coveralls.io/r/ma-si/ipstack-adapter?branch=master
  [Code Climate image]: https://img.shields.io/codeclimate/github/ma-si/ipstack-adapter.svg?style=flat-square
  [Code Climate]: https://codeclimate.com/github/ma-si/ipstack-adapter
  [Packagist image]: https://img.shields.io/packagist/v/aist/ipstack-adapter.svg?style=flat-square
  [Packagist]: https://packagist.org/packages/aist/ipstack-adapter
  [License image]: https://poser.pugx.org/aist/ipstack-adapter/license?format=flat-square
  [License]: https://opensource.org/licenses/BSD-3-Clause
