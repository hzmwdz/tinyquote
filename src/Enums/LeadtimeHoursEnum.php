<?php

namespace Hzmwdz\Tinyquote\Enums;

class LeadtimeHoursEnum
{
    const HOURS_12 = 12;
    const HOURS_24 = 24;
    const HOURS_48 = 48;
    const HOURS_72 = 72;
    const HOURS_120 = 120;
    const HOURS_168 = 168;
    const HOURS_240 = 240;
    const HOURS_360 = 360;
    const HOURS_480 = 480;

    /**
     * @return array
     */
    public static function all()
    {
        return [
            self::HOURS_12,
            self::HOURS_24,
            self::HOURS_48,
            self::HOURS_72,
            self::HOURS_120,
            self::HOURS_168,
            self::HOURS_240,
            self::HOURS_360,
            self::HOURS_480,
        ];
    }
}
