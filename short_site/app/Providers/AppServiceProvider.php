<?php

namespace App\Providers;

use App\Contracts\RpcClient;
use App\Services\JsonRpcClient;
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
        $this->app->singleton(RpcClient::class, function ($app) {
            return new JsonRpcClient(config("app.rpc_server"));
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