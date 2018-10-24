<?php

namespace Linuxstreet\Registry\Console;

use Illuminate\Console\Command;
use Linuxstreet\Registry\Registry;

/**
 * Class RegistryConfig.
 */
class RegistryConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registry:config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all registry items that are stored as config variables.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $items = Registry::orderBy('key')->get(['key']);

        if ($items->isEmpty()) {
            $this->info('Registry is empty.');

            return;
        }

        $config = $items->map(function ($i) {
            return [Registry::configKey($i->key), $i->getConfigValueAsString()];
        });

        $headers = ['Config key', 'Value'];
        $this->table($headers, $config->all());
    }
}
