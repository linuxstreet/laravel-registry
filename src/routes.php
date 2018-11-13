<?php

// Registry routes...
$routeConfig = [
    'namespace' => 'Linuxstreet\Registry',
    'middleware' => config('registry.settings.middleware'),
    'prefix' => config('registry.settings.route_prefix')
];

Route::group($routeConfig, function () {
    Route::get(config('registry.settings.path'), 'RegistryController@index')
        ->name('registry.index');

    Route::post(config('registry.settings.path'), 'RegistryController@store')
        ->name('registry.store');

    Route::get(config('registry.settings.path') . '/create', 'RegistryController@create')
        ->name('registry.create');

    Route::get(config('registry.settings.path') . '/{registry}', 'RegistryController@show')
        ->name('registry.show');

    Route::patch(config('registry.settings.path') . '/{registry}', 'RegistryController@update')
        ->name('registry.update');

    Route::delete(config('registry.settings.path') . '/{registry}', 'RegistryController@destroy')
        ->name('registry.destroy');

    Route::get(config('registry.settings.path') . '/{registry}/edit', 'RegistryController@edit')
        ->name('registry.edit');
});
