<?php

namespace App\Providers;

use App\Contracts\RpcServer;
use App\Services\JsonRpcServer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RpcServer::class, function ($app) {
            return new JsonRpcServer($app);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}