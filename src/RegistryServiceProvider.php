<?php

namespace Linuxstreet\Registry;

use Illuminate\Support\ServiceProvider;
use Linuxstreet\Registry\Console\RegistryConfig;
use Linuxstreet\Registry\Console\RegistryFlush;
use Linuxstreet\Registry\Console\RegistryList;

/**
 * Class RegistryServiceProvider.
 */
class RegistryServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'registry');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'registry');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Load helpers
        require_once __DIR__.'/helpers.php';

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        app(Registry::class)->saveToConfig();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/registry.php', 'registry');

        // Register the service the package provides.
        $this->app->singleton('registry', function ($app) {
            return new Registry;
        });

        // Load registry admin routes
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['registry'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/registry.php' => config_path('registry.php'),
        ], 'registry.config');

        // Publishing the views.
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/linuxstreet'),
        ], 'registry.views');

        // Registering package commands.
        $this->commands([
            RegistryList::class,
            RegistryFlush::class,
            RegistryConfig::class,
        ]);
    }
}
