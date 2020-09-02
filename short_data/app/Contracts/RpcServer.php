<?php
namespace App\Contracts;

interface RpcServer {
    public function register(string $method, string $class);

    public function handle();
}