<?php

namespace Drupal\wmcontroller_flysystem;

use Drupal\flysystem\FlysystemFactory;

class FileSystemFactory
{
    public static function create(FlysystemFactory $factory, $scheme)
    {
        return $factory->getFilesystem($scheme);
    }
}