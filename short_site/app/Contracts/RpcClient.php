<?php
namespace App\Contracts;

interface RpcClient {
    public function call(string $method, array $data);
}