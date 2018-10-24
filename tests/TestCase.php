<?php

namespace Linuxstreet\Registry\Tests;

use Linuxstreet\Registry\Facades\Registry;
use Linuxstreet\Registry\RegistryServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider
     * @param  \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [RegistryServiceProvider::class];
    }

    /**
     * Load package alias
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app): array
    {
        return [
            'Registry' => Registry::class,
        ];
    }
}
