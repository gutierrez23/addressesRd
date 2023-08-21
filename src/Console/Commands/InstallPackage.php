<?php

namespace FgutierrezPHP\AddresesRd\Console\Commands;

use Illuminate\Console\Command;
use FgutierrezPHP\AddresesRd\Database\Seeders\DataGeographicSeeder;

class InstallPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:addreses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call(DataGeographicSeeder::class);
    }
}
