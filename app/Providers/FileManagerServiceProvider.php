<?php

namespace App\Providers;

use App\Service\FileManager;
use Illuminate\Support\ServiceProvider;

class FileManagerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(FileManager::class, function () {
            return new FileManager(config('filesystems.disks.myDisks.storage'));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
    }
}
