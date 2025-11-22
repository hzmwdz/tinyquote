<?php

namespace Hzmwdz\Tinyquote\Support;

class NullableValue
{
    /**
     * @param mixed $value
     * @return string|null
     */
    public static function string($value)
    {
        return self::isNullLike($value) ? null : (string) $value;
    }

    /**
     * @param mixed $value
     * @return float|null
     */
    public static function float($value)
    {
        return self::isNullLike($value) ? null : (float) $value;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    protected static function isNullLike($value)
    {
        return $value === null || strtoupper(trim((string) $value)) === 'NULL';
    }
}
