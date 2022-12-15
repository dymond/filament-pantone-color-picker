<?php

namespace dymond\FilamentPantoneColorPicker\Commands;

use Illuminate\Console\Command;

class FilamentPantoneColorPickerCommand extends Command
{
    public $signature = 'filament-pantone-color-picker';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
