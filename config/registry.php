<?php

return [
    'settings' => [

        /*
         |--------------------------------------------------------------------------
         | Config Key
         |--------------------------------------------------------------------------
         |
         | Root config key to be used with Laravel's config() method.
         | For example to get value of 'some_key' from registry
         | you can then use: config('registry.some_key').
         |
         */
        'config_key' => 'registry',

        /*
         |--------------------------------------------------------------------------
         | Route Prefix
         |--------------------------------------------------------------------------
         |
         | Route prefix option to be used on the web route
         | when accessing registry admin panel.
         |
         */
        'route_prefix' => 'admin',

        /*
         |--------------------------------------------------------------------------
         | Route Middleware
         |--------------------------------------------------------------------------
         |
         | Route middleware to be applied on the web route when accessing registry
         | admin panel. Please note that 'web' and 'bindings' will be applied
         | by default.
         |
         */
        'route_middleware' => [],

        /*
         |--------------------------------------------------------------------------
         | Log Missing Keys
         |--------------------------------------------------------------------------
         |
         | Whether to log requested missing keys from registry or not.
         | If enabled missing keys will be logged using Laravel's
         | Log facade.
         |
         */
        'log_missing_keys' => true,
    ]
];
