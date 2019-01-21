# Patrick Tournet's Laravel Frontend Preset (based on Adam Wathan's one)

A Laravel frontend preset that scaffolds out new applications just the way I like 'em!

What it includes:

- [Tailwind CSS](https://tailwindcss.com) with a configuration file
- [postcss-nesting](https://github.com/jonathantneal/postcss-nesting) for nested CSS support
- [Purgecss](https://www.purgecss.com/), via [spatie/laravel-mix-purgecss](https://github.com/spatie/laravel-mix-purgecss)
- [Vue.js](https://vuejs.org/)
- Removes Bootstrap and jQuery
- Adds compiled assets to `.gitignore`
- Adds a simple Tailwind-tuned default layout template
- Replaces the `welcome.blade.php` template with one that extends the main layout

## Installation

This package isn't on Packagist (yet), so to get started, add it as a repository to your `composer.json` file:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/ptournet/laravel-preset"
    }
]
```

Next, run this command to add the preset to your project:

```
composer require ptournet/laravel-preset --dev
```

Finally, apply the scaffolding by running:

```
php artisan preset mine
```

## Roadmap

I intend to implement the following features :

- Replace the `make:auth` templates with simplified ones styled with Tailwind CSS
- Create a new `tailvue` preset replacing all the original templates with visually identical content Tailwind styled (could end up being a PR in Laravel)
- Of course, update Tailwind, Vue.js, postcss, Purgecss and Laravel to the most recent versions