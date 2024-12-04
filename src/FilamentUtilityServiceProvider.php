<?php

namespace Joinapi\FilamentUtility;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;
use Filament\FilamentServiceProvider;
class FilamentUtilityServiceProvider extends FilamentServiceProvider
{

    public function packageBooted(): void
    {
        parent::packageBooted();

        FilamentAsset::register([
            Js::make('money-script', __DIR__.'/../resources/js/money.js'),
        ]);
    }


}
