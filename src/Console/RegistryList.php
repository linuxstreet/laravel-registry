<?php

namespace Linuxstreet\Registry\Console;

use Illuminate\Console\Command;
use Linuxstreet\Registry\Registry;

/**
 * Class RegistryList
 *
 * @package Linuxstreet\Registry
 */
class RegistryList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registry:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all registry items in the database.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $items = Registry::orderBy('key')->get(['key', 'type', 'value', 'comment']);

        if ($items->isEmpty()) {
            $this->info('Registry is empty.');

            return;
        }

        $headers = collect(array_keys($items->first()->toArray()))->map(function ($i) {
            return ucwords($i);
        })->all();

        $this->table($headers, $items);
    }
}
