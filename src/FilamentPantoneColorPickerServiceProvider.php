<?php

namespace dymond\FilamentPantoneColorPicker;

use dymond\FilamentPantoneColorPicker\Forms\Components\PantoneColorPicker;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentPantoneColorPickerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-pantone-color-picker')
            ->hasViews()
            ->hasAssets();
    }
    public function packageBooted() {
        Livewire::component('filament-pantone-color-picker::pantone-color-picker', PantoneColorPicker::class);
    }
}
