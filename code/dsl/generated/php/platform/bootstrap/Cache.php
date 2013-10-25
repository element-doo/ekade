<?php
namespace NGS;

abstract class Cache
{
    private static function getPath($key)
    {
        return sprintf('%s%08X.cache', __DIR__.'/../cache/', crc32($key));
    }

    public static function get($key)
    {
        $path = self::getPath($key);
        if (!is_file($path)) {
            return null;
        }

        return file_get_contents($path);
    }

    public static function set($key, $body)
    {
        $path = self::getPath($key);
        $parent = pathinfo($path, PATHINFO_DIRNAME);

        if (!is_dir($parent)) {
            mkdir($parent, 0777, true);
        }

        return file_put_contents($path, $body);
    }

    public static function delete($key)
    {
        $path = self::getPath($key);
        if (!is_file($path)) {
            return null;
        }

        return unlink($path);
    }
}
