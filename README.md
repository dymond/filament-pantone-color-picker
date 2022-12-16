# Pantone Color Picker for FilamentPHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dymond/filament-pantone-color-picker.svg?style=flat-square)](https://packagist.org/packages/dymond/filament-pantone-color-picker)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/dymond/filament-pantone-color-picker/run-tests?label=tests)](https://github.com/dymond/filament-pantone-color-picker/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/dymond/filament-pantone-color-picker/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/dymond/filament-pantone-color-picker/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/dymond/filament-pantone-color-picker.svg?style=flat-square)](https://packagist.org/packages/dymond/filament-pantone-color-picker)


## Requirements
- PHP 8.0+
- Laravel 8.0+
- Livewire 2.0+
- FilamentPHP 2.0+

## Installation

You can install the package via composer:

```bash
composer require dymond/filament-pantone-color-picker
```

The package uses the following dependencies:
- [Alpinejs](https://alpinejs.dev/)
- [Tailwind CSS](https://tailwindcss.com/)
- [Tailwind CSS Forms Plugin](https://github.com/tailwindlabs/tailwindcss-forms)
- [Tailwind CSS Typography Plugin](https://tailwindcss.com/docs/typography-plugin)

```bash
pnpm install alpinejs tailwindcss @tailwindcss/forms @tailwindcss/typography --save-dev
```

### Configuring Tailwind CSS

To finish installing Tailwind, you must create a new `tailwind.config.js` file in the root of your project. The easiest way to do this is by running `npx tailwindcss init`.

In `tailwind.config.js`, register the plugins you installed, and add custom colors used by the form builder:

```js
const colors = require('tailwindcss/colors') 
 
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './vendor/filament/**/*.blade.php', 
    ],
    theme: {
        extend: {
            colors: { 
                danger: colors.rose,
                primary: colors.blue,
                success: colors.green,
                warning: colors.yellow,
            }, 
        },
    },
    plugins: [
        require('@tailwindcss/forms'), 
        require('@tailwindcss/typography'), 
    ],
}
```
Of course, you may specify your own custom `primary`, `success`, `warning` and `danger` colors, which will be used instead.

## Bundling Assets

New Laravel projects use Vite for bundling assets by default. However, your project may still use Laravel Mix. Read the steps below for the bundler used in your project.

### Vite
If you're using Vite, you should manually install [Autoprefixer](https://github.com/postcss/autoprefixer) through NPM:

Create a `postcss.config.js` file in the root of your project, and register Tailwind CSS and Autoprefixer as plugins:

```js
module.exports = {
    plugins: {
        tailwindcss: {},
        autoprefixer: {},
    },
}
```
You may also want to update your `vite.config.js` file to refresh the page after Livewire components or custom form components have been updated:
```js
import { defineConfig } from 'vite'
import laravel, { refreshPaths } from 'laravel-vite-plugin' 
 
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: [ 
                ...refreshPaths,
                'app/Http/Livewire/**',
                'app/Forms/Components/**',
            ], 
        }),
    ],
})
```
### Configuring styles
In `/resources/css/app.css`, import `filament/forms` vendor CSS and [Tailwind CSS](https://tailwindcss.com/):

```js
import Alpine from 'alpinejs'
import FormsAlpinePlugin from '../../vendor/filament/forms/dist/module.esm'
import NotificationsAlpinePlugin from '../../vendor/filament/notifications/dist/module.esm'
 
Alpine.plugin(FormsAlpinePlugin)
Alpine.plugin(NotificationsAlpinePlugin)
 
window.Alpine = Alpine
 
Alpine.start()
```






















You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="master-forms-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="master-forms-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="master-forms-views"
```

## Usage

```php
$masterForms = new Tjmpromos\MasterForms();
echo $masterForms->echoPhrase('Hello, Tjmpromos!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Mike Wall](https://github.com/daikazu)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
