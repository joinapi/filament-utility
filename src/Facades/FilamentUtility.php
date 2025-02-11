<?php

namespace Joinapi\FilamentUtility\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @see \Joinapi\FilamentUtility\FilamentUtility
 */
class FilamentUtility extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Joinapi\FilamentUtility\FilamentUtility::class;
    }
}
