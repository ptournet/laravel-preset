<?php

namespace Ptournet\LaravelPreset;

use Illuminate\Support\Arr;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset as BasePreset;
use Symfony\Component\Process\Process;

class MyPreset extends BasePreset
{
    public static function install($command)
    {
        static::ensureComponentDirectoryExists();
        static::updatePackages();
        static::updateStyles();
        static::updateWebpackConfiguration();
        static::updateJavaScript();
        static::updateTemplates();
        static::removeNodeModules();
        static::updateGitignore();
        static::updateNpmRunScript($command);
    }

    protected static function updatePackageArray(array $packages)
    {
        return array_merge([
            'laravel-mix-purgecss' => '^2.2.0',
            'postcss-nesting' => '^5.0.0',
            'postcss-import' => '^11.1.0',
            'tailwindcss' => '>=0.7.3',
        ], Arr::except($packages, [
            'bootstrap',
            'bootstrap-sass',
            'jquery',
            'popper.js',
        ]));
    }

    protected static function updateWebpackConfiguration()
    {
        copy(__DIR__.'/mystubs/webpack.mix.js', base_path('webpack.mix.js'));
    }

    protected static function updateStyles()
    {
        tap(new Filesystem, function ($files) {
            $files->deleteDirectory(resource_path('sass'));
            $files->delete(public_path('js/app.js'));
            $files->delete(public_path('css/app.css'));

            if (! $files->isDirectory($directory = resource_path('css'))) {
                $files->makeDirectory($directory, 0755, true);
            }
        });

        copy(__DIR__.'/mystubs/resources/css/app.css', resource_path('css/app.css'));
    }

    protected static function updateJavaScript()
    {
        copy(__DIR__.'/mystubs/app.js', resource_path('js/app.js'));
        copy(__DIR__.'/mystubs/bootstrap.js', resource_path('js/bootstrap.js'));
    }

    protected static function updateTemplates()
    {
        tap(new Filesystem, function ($files) {
            $files->delete(resource_path('views/home.blade.php'));
            $files->delete(resource_path('views/welcome.blade.php'));
            $files->copyDirectory(__DIR__.'/mystubs/views', resource_path('views'));
        });
    }

    protected static function updateGitignore()
    {
        copy(__DIR__.'/mystubs/gitignore-stub', base_path('.gitignore'));
    }

    protected static function updateNpmRunScript($command)
    {
        $command->line("--- npm install ---");
        system('npm install');

        $command->line("--- tailwind init ---");
        system(base_path('node_modules/.bin/tailwind init'));

        $command->line("--- npm run dev ---");
        system('npm run dev');
    }
}
