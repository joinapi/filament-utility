<?php

namespace Joinapi\FilamentUtility\Support;

use Illuminate\Support\Str;

class Strings
{
    public static function mask($val, $mask)
    {
        if (empty($val)) {
            return '';
        }
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k])) {
                    $maskared .= $val[$k++];
                }
            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }

        return $maskared;
    }

    public static function onlyNumbers($value): string
    {
        if( empty($value)){
            return '';
        }
        return mb_trim(Str::of($value)->replaceMatches('/[^0-9]/', ''));
    }
}
