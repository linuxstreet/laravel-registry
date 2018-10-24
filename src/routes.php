<?php

// Registry routes...
$routeConfig = [
    'namespace' => 'Linuxstreet\Registry',
    'middleware' => array_merge((array) $this->app['config']->get('registry.settings.route_middleware'),
        ['bindings', 'web']),
    'prefix' => $this->app['config']->get('registry.settings.route_prefix')
];

Route::group($routeConfig, function () {
    Route::resource('registry', 'RegistryController');
});
