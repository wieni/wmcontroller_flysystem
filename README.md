wmcontroller_flysystem
======================

[![Latest Stable Version](https://poser.pugx.org/wieni/wmcontroller_flysystem/v/stable)](https://packagist.org/packages/wieni/wmcontroller_flysystem)
[![Total Downloads](https://poser.pugx.org/wieni/wmcontroller_flysystem/downloads)](https://packagist.org/packages/wieni/wmcontroller_flysystem)
[![License](https://poser.pugx.org/wieni/wmcontroller_flysystem/license)](https://packagist.org/packages/wieni/wmcontroller_flysystem)

> A [Flysystem](https://flysystem.thephpleague.com) cache storage for [wieni/wmcontroller](https://github.com/wieni/wmcontroller)

## Installation

This package requires PHP 8.0 and Drupal 9 or higher. It can be
installed using Composer:

```bash
 composer require wieni/wmcontroller_flysystem
```

To enable this cache storage, change the following container parameters:
```yaml
parameters:
    wmcontroller.cache.storage: wmcontroller.cache.storage.flysystem

    # Backend storage responsible for keeping track of tags and cache entries
    wmcontroller.cache.flysystem.backend.storage: wmcontroller.cache.storage.mysql

    wmcontroller.cache.flysystem.scheme: wmcontrollerscheme
    wmcontroller.cache.flysystem.directory: wmcontroller
```

Make sure to also set the flysystem scheme in `settings.php`.

```php
// settings.php

$settings['flysystem'] = [
    'wmcontrollerscheme' => [
        'driver' => 'local',
        'config' => [
            'root' => 'sites/default/cache',
            'public' => false,
        ],
        'serve_js' => true,
        'serve_css' => true,
    ],
];

// Or if you want to store your cache on S3
// This requires the drupal/flysystem_s3 module
$settings['flysystem'] = [
    'wmcontrollerscheme' => [
        'driver' => 's3',
        'config' => [
            'key' => $_ENV['S3_KEY'],
            'secret' => $_ENV['S3_SECRET'],
            'region' => $_ENV['S3_REGION'],
            'bucket' => $_ENV['S3_BUCKET'],
            'prefix' => $_ENV['S3_PREFIX'] ?? '',
            'cname' => $_ENV['S3_CNAME'] ?? '',
            'options' => [
                'ACL' => 'private',
            ],
            'protocol' => 'https',
            'public' => false,
        ],
        'cache' => false,
        'serve_js' => false,
        'serve_css' => false,
    ],
];
```

## Changelog
All notable changes to this project will be documented in the
[CHANGELOG](CHANGELOG.md) file.

## Security
If you discover any security-related issues, please email
[security@wieni.be](mailto:security@wieni.be) instead of using the issue
tracker.

## License
Distributed under the MIT License. See the [LICENSE](LICENSE) file
for more information.
