<?php

namespace Ptournet\LaravelPreset;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\PresetCommand;

class PresetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        PresetCommand::macro('mine', function ($command) {
            MyPreset::install($command);

            $command->info('My own scaffolding installed successfully.');
            $command->info('"npm install && tailwind init && npm run dev" have already been run to compile your fresh scaffolding...');
            $command->info('So, enjoy and build something great!');
        });
    }
}
