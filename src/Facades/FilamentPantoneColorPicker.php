<?php

namespace dymond\FilamentPantoneColorPicker\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \dymond\FilamentPantoneColorPicker\FilamentPantoneColorPicker
 */
class FilamentPantoneColorPicker extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \dymond\FilamentPantoneColorPicker\FilamentPantoneColorPicker::class;
    }
}
