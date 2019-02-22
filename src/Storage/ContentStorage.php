<?php

namespace Drupal\wmcontroller_flysystem\Storage;

use Drupal\wmcontroller\Entity\Cache;
use League\Flysystem\FilesystemInterface;

class ContentStorage
{
    /** @var \League\Flysystem\FilesystemInterface */
    protected $fs;
    protected $directory;

    public function __construct(
        FilesystemInterface $fs,
        $directory
    ) {
        $this->fs = $fs;
        $this->directory = trim($directory, "\\/ \t\n\r\0\x0B") . '/';
    }

    public function storeBodyOnFileSystem(Cache $cache)
    {
        if (!$cache->getBody()) {
            return $cache;
        }

        $path = $this->directory . $cache->getId();

        $this->fs->put(
            $path,
            $cache->getBody()
        );

        return new Cache(
            $cache->getId(),
            $cache->getMethod(),
            $cache->getUri(),
            $path,
            $cache->getHeaders(),
            $cache->getExpiry()
        );
    }

    public function readBodyOnFileSystem(Cache $cache)
    {
        if (!$cache->getBody()) {
            return $cache;
        }

        try {
            $body = $this->fs->read($cache->getBody());
        } catch (\Exception $e) {
            return null;
        }

        return new Cache(
            $cache->getId(),
            $cache->getMethod(),
            $cache->getUri(),
            $body,
            $cache->getHeaders(),
            $cache->getExpiry()
        );
    }

    public function removeFromFileSystem(array $ids)
    {
        foreach ($ids as $id) {
            try {
                $this->fs->delete($this->directory . $id);
            } catch (\Exception $e) {
                //
            }
        }
    }

    public function flushFileSystem()
    {
        try {
            $this->fs->deleteDir($this->directory);
        } catch (\Exception $e) {
            //
        }
    }
}