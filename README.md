# FlySystem storage for WmController

This is a FlySystem storage for [wieni/wmcontroller](https://github.com/wieni/wmcontroller)

## Installation

```bash
composer require wieni/wmcontroller_flysystem
drush en wmcontroller_flysystem
```

```yaml
// services.yml
parameters:
    # Backend storage responsible for keeping track of tags and cache entries
    wmcontroller.cache.flysystem.backend.storage: wmcontroller.cache.storage.mysql

    wmcontroller.cache.flysystem.scheme: wmcontrollerscheme
    wmcontroller.cache.flysystem.directory: wmcontroller
```

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
