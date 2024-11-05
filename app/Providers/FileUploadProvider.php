<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FileUploadService;
class FileUploadProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(FileUploadService::class, function ($app) {
            return new FileUploadService();
        });

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
