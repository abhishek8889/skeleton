<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;
// use Illuminate\Support\Facades\View;
use App\Services\ModelService;
use App\Models\User;


class ModelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ModelService::class, function ($app) {
			return new ModelService($app->make(Container::class));
		});
        
        $this->app->bind(User::class, fn () => new User());

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
