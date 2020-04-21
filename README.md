# A tile to display the status of Velo, the Antwerp bike sharing system

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-dashboard-velo-tile.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-dashboard-velo-tile
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/spatie/laravel-dashboard-velo-tile/run-tests?label=tests)](https://github.com/spatie/:package_name/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-dashboard-velo-tile.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-dashboard-velo-tile

This tile can used on the [Laravel Dashboard](https://github.com/spatie/laravel-dashboard) to display the status of Velo, the Antwerp bike sharing system

![screenshot](TODO: add link)

## Support us

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us). 

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require spatie/laravel-dashboard-velo-tile
```

In the `dashboard` config file, you must add this configuration in the `tiles` key. The `ids` should contain the ids of the velo stations that you want to display on the dashboard.

```php
// in config/dashboard.php

return [
    // ...
    'tiles' => [
        'velo' => [
            'stations' => [],
    ],
];
```

In `app\Console\Kernel.php` you should schedule the `Spatie\VeloTile\FetchVeloStationsCommand` to run. You can let in run every minute if you want. You could also run is less frequently if you fast updates on the dashboard aren't that important for this tile.

```php
// in app/console/Kernel.php

protected function schedule(Schedule $schedule)
{
    // ...
    $schedule->command(Spatie\VeloTile\FetchVeloStationsCommand::class)->everyMinute();
}
```

## Usage

In your dashboard view you use the `livewire:velo-tile` component. 

```html
<x-dashboard>
    <livewire:velo-tile position="a1" />
</x-dashboard>
```

### Customizing the view

If you want to customize the view used to render this tile, run this command:

```bash
php artisan vendor:publish --provider="Spatie\VeloTile\VeloTileServiceProvider" --tag="dashboard-velo-tile-views"
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
