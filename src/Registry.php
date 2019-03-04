<?php

namespace Linuxstreet\Registry;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

/**
 * Class Registry.
 *
 * @property int id
 * @property string key
 * @property mixed value
 * @property string type
 * @property string comment
 * @method convert($value, $type)
 */
class Registry extends Model
{
    /**
     * @var string
     */
    protected $table = 'registry';

    /**
     * @var array
     */
    public static $types = ['numeric', 'string', 'array', 'boolean', 'json'];

    /**
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
        'type',
        'comment'
    ];

    /**
     * Key to save values to within the registry.
     */
    private const STORE_KEY = 'store';

    /**
     * Name of the key that will be used with config when
     * storing registry key/value pairs.
     *
     * @var string
     */
    private static $configKey = 'registry';

    /**
     * Save settings to config.
     *
     * @return void
     */
    public static function saveToConfig(): void
    {
        // Test database connection
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return;
        }

        // Check if table exists
        if (! Schema::hasTable((new self())->table)) {
            return;
        }

        foreach (self::all() as $item) {
            $value = self::castToType($item->value, $item->type);
            Config::set(self::configKey($item->key), $value);
        }
    }

    /**
     * Get value from the registry by a given key.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed|null
     */
    public static function get($key, $default = null)
    {
        $key = self::configKey($key);

        if (Config::has($key)) {
            return Config::get($key, $default);
        }

        if (config('registry.settings.log_missing_keys')) {
            Log::info("Registry key: '{$key}' is used but not defined in the registry.");
        }
    }

    /**
     * Get the config key string.
     * If $key is provided it will be concatenated to the base config key.
     *
     * @param string $key
     * @return string
     */
    public static function configKey($key = null): string
    {
        return $key === null ? (self::$configKey . '.' . self::STORE_KEY) : (self::$configKey . ".{$key}");
    }

    /**
     * Cast registry value to its defined type.
     *
     * @param $value
     * @param $type
     * @return array|float|bool|object
     */
    private static function castToType($value, $type)
    {
        switch ($type) {
            case 'boolean':
                $value = (bool) $value;
                break;
            case 'array':
                $value = str_getcsv($value);
                break;
            case 'numeric':
                $value = (float) $value;
                break;
            case 'json':
                $value = json_decode($value);
                break;
        }

        return $value;
    }

    /**
     * Set the key value pairs in registry.
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value): void
    {
        Config::set(self::configKey($key), $value);
    }

    /**
     * Get string representation from the registry config key.
     *
     * @return string
     */
    public function getConfigValueAsString(): string
    {
        return var_export(config(self::configKey($this->key)), true);
    }
}
