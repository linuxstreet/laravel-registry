<?php

namespace Linuxstreet\Registry\Console;

use Illuminate\Console\Command;
use Linuxstreet\Registry\Registry;
use Illuminate\Support\Facades\Artisan;

/**
 * Class RegistryFlush.
 */
class RegistryFlush extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registry:flush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flush registry items and related config keys.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        Registry::truncate();
        Artisan::call('config:clear');

        $this->info('All registry items were deleted.');
    }
}
