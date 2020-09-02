<?php

namespace App\Facades;

use App\Contracts\RpcServer as RpcServerContract;
use Illuminate\Support\Facades\Facade;

class RpcServer extends Facade {
    protected static function getFacadeAccessor()
    {
        return RpcServerContract::class;
    }
}