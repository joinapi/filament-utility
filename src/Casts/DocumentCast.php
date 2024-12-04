<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DocumentCast  implements CastsAttributes
{

    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        return $value;
    }

    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        if (empty($value)) {
            return null;
        }
        $newvalue = Str::of($value)->replaceMatches('/[^0-9]/', '');

        if (empty($newvalue)) {
            return null;
        }

        return $newvalue;
    }
}
