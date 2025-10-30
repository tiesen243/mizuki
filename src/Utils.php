<?php

namespace Core;

class Utils
{
    public static function createId(): string
    {
        $timestamp = base_convert((string)floor(microtime(true) * 1000), 10, 36);
        $random = substr(bin2hex(random_bytes(8)), 0, 23 - strlen($timestamp));
        return 'c' . str_pad($timestamp, 8, '0', STR_PAD_LEFT) . $random;
    }
}
