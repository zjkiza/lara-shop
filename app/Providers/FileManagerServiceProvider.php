<?php

namespace App\Providers;

use App\Service\FileManager;
use Illuminate\Support\ServiceProvider;

class FileManagerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(FileManager::class, function (){

            return new FileManager(config('filesystems.disks.myDisks.storage'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
