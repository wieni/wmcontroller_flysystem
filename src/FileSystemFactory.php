<?php

namespace Drupal\wmcontroller_flysystem;

use Drupal\flysystem\FlysystemFactory;
use League\Flysystem\FilesystemInterface;

class FileSystemFactory
{
    public static function create(FlysystemFactory $factory, $scheme): FilesystemInterface
    {
        return $factory->getFilesystem($scheme);
    }
}
