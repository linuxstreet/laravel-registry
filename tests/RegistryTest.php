<?php

namespace Linuxstreet\Registry\Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\ServiceProvider;
use Linuxstreet\Registry\Registry;
use Linuxstreet\Registry\RegistryServiceProvider;

class RegistryTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @var ServiceProvider placeholder
     */
    protected $serviceProvider;

    /**
     * Setup tests
     *
     * @return void
     */
    public function setUp()
    {
        $this->serviceProvider = new RegistryServiceProvider(\Mockery::mock(Application::class));

        parent::setUp();

        $this->withFactories(realpath(dirname(__DIR__) . '/database/factories'));
    }

    /** @test */
    public function it_is_constructed_as_a_service_provider()
    {
        $this->assertInstanceOf(ServiceProvider::class, $this->serviceProvider);
    }

    /** @test */
    public function it_returns_null_if_not_saved_to_config()
    {
        factory(Registry::class, 1)->create(['key' => 'k1', 'type' => 'string', 'value' => 'Value']);

        $this->assertNull(registry::get('k1'));
    }

    /** @test */
    public function it_returns_a_value_after_registry_is_saved_to_config()
    {
        factory(Registry::class, 1)->create(['key' => 'k1', 'type' => 'string', 'value' => 'Value']);

        app(Registry::class)->saveToConfig();

        $this->assertEquals('Value', registry::get('k1'));
    }

    /** @test */
    public function it_returns_array_type_when_key_type_is_defined_as_array()
    {
        factory(Registry::class, 1)->create(['key' => 'k1', 'type' => 'array', 'value' => '1,2,3,4']);

        app(Registry::class)->saveToConfig();

        $this->assertEquals([1, 2, 3, 4], registry::get('k1'));
    }

    /** @test */
    public function it_returns_boolean_type_when_key_type_is_defined_as_boolean()
    {
        factory(Registry::class, 1)->create(['key' => 'k1', 'type' => 'boolean', 'value' => 1]);

        app(Registry::class)->saveToConfig();

        $this->assertTrue(registry::get('k1'));
    }

    /** @test */
    public function it_returns_object_of_stdclass_when_key_type_is_defined_as_json()
    {
        factory(Registry::class, 1)->create(['key' => 'k1', 'type' => 'json', 'value' => '{"key":"value"}']);

        app(Registry::class)->saveToConfig();

        $this->assertObjectHasAttribute('key', registry::get('k1'));
    }

    /** @test */
    public function it_sets_a_key_value_pair_when_set_method_is_called()
    {
        factory(Registry::class, 1)->create(['key' => 'k1', 'type' => 'json', 'value' => '{"key":"value"}']);

        Registry::set('k1', 'value');

        $this->assertEquals('value', registry::get('k1'));
    }
}
