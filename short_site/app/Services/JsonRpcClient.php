<?php
namespace App\Services;

use App\Exceptions\RpcClientException;
use App\Contracts\RpcClient;
use Illuminate\Support\Facades\Http;

class JsonRpcClient implements RpcClient
{
    private const JSON_RPC_VERSION = "2.0";

    private $message_id;

    private $end_point;

    public function __construct(string $end_point)
    {
        $this->message_id = 1;
        $this->end_point = $end_point;
    }

    public function call(string $method, array $data): array {
        $response = Http::post($this->end_point, [
            "jsonrpc" => Self::JSON_RPC_VERSION,
            "method" => $method,
            "params" => $data,
            "id" => $this->message_id
        ]);

        $this->message_id += 1;

        if ($response->failed()) {
            throw new RpcClientException();
        }

        $data = $response->json();

        if (array_key_exists("error", $data)) {
            throw new RpcClientException($data["error"]["message"]);
        }

        return $data["result"];
    }
}