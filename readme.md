# Registry for Laravel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]


Registry package provides a convenient way to manage and use simple key/value pairs (with pre-defined types) by using Laravel's under-laying config() functionality.

When application boots, registry entries are saved into Laravel's config so no registry calls will hit the database beyond that point.

The main difference is that keys/values are saved in database and there is no need to manually edit config files.
 
Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require linuxstreet/laravel-registry
```
Migrate your database:
```bash
$ php artisan migrate
```

If you're using Laravel < 5.5 you'll need to add the service provider to your config/app.php

``` bash
'Linuxstreet\Registry\RegistryServiceProvider::class'
```
## Configuration
You can publish config and view files using the artisan command:
```bash
$ php artisan vendor:publish --provider="Linuxstreet\Registry\RegistryServiceProvider"
```

## Usage
Check the config file and make necessary changes if needed.

You can add/edit registry entries by using web provided web forms. 

By default use: http://your-website/admin/registry/


#### Console helpers:
List registry key/values as stored in database:
```bash
$ php artisan registry:list
```

List registry config keys with their real php values:
```bash
$ php artisan registry:config
```

Flush all registry items (will permanently delete registry entries from database):
```bash
$ php artisan registry:flush
```

#### Using registry items in your code:

You can access registry entries by using provided registry() helper:
```php 
registry('key', 'default');
```
or using Registry facade:
```php
Registry::get('key', 'default');
```
or using Laravel config() helper:

```php
config('registry.key', 'default');
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- Igor Jovanovic

## License

Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/linuxstreet/registry.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/linuxstreet/registry.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/linuxstreet/registry/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/linuxstreet/registry
[link-downloads]: https://packagist.org/packages/linuxstreet/registry
[link-travis]: https://travis-ci.org/linuxstreet/registry
[link-styleci]: https://styleci.io/repos/152642206/shield
[link-author]: https://github.com/linuxstreet
