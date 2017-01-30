<?php

namespace Common;

class FileCache
{
    /*
     * Create file with cache
     */
    public static function createCache($fileName, $data)
    {
        $fileRoot = SITE_DIR . DS . 'cache' . DS . 'products' . DS . $fileName . '.cache';

        $data = serialize($data);

        file_put_contents($fileRoot, $data);
    }

    /*
     * Read file with cache
     */
    public static function readCache($fileName)
    {

	$fileRoot = SITE_DIR . DS . 'cache' . DS . 'products' . DS . $fileName. '.cache';

        if(file_exists($fileRoot) && $data = file_get_contents($fileRoot)) {

            return unserialize($data);
        }

        return null;
    }

    /*
     * Delete file with cache
     */
    public static function deleteCache($root)
    {
        $files = glob($root . '/*');

        foreach ($files as $value) {

            unlink($value);
        }
    }
}