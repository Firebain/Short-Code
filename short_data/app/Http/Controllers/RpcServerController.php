<?php

namespace App\Http\Controllers;

use App\Contracts\RpcServer;

class RpcServerController extends Controller
{
    public function __invoke(RpcServer $rpc_server)
    {
        return $rpc_server->handle();
    }
}