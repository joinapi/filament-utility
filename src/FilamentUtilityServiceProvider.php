<?php

namespace Joinapi\FilamentUtility;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

class FilamentUtilityServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        FilamentAsset::register([
            Js::make('money-script', __DIR__.'/../resources/js/money.js'),
        ]);
    }

    public function boot()
    {

    }
}
