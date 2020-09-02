<?php

use App\Facades\RpcServer;

RpcServer::register("show", "DataController@show");
RpcServer::register("store", "DataController@store");