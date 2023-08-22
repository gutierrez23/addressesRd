<?php

namespace FgutierrezPHP\AddresesRd;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use FgutierrezPHP\AddresesRd\Database\Seeds\DataGeographicSeeder;
use FgutierrezPHP\AddresesRd\Console\Commands\InstallPackage;

class AddressRdServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/addreses_rd.php', 'addreses_rd');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish Config
        $this->publishes([
            __DIR__.'/../config/addreses_rd.php' => config_path('addreses_rd.php'),
        ]);
        // Load Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        // Load Migrations
        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');
        // Publish Migrations
        // if (!Schema::hasTable(config('addreses_rd.tables_prefix') . 'provinces')) {
            $this->publishes([
                __DIR__.'/Database/migrations/create_addresses_rd_migration.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_addresses_rd_migration.php'),
            ], 'migrations');
        // }
        // Load Commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallPackage::class,
            ]);
        }
    }
}