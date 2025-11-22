<?php

namespace Hzmwdz\Tinyquote\Support;

use Illuminate\Support\Facades\Config;

class ConfigHelper
{
    public const NAME = 'tinyquote';

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        return Config::get(self::NAME . '.' . $key, $default);
    }

    /**
     * @return string
     */
    public static function cachePrefix()
    {
        return self::get('cache_prefix', self::NAME . '_cache');
    }

    /**
     * @param int $default
     * @return int
     */
    public static function cacheTTL($default = 3600)
    {
        return self::get('cache_ttl', $default);
    }
}
