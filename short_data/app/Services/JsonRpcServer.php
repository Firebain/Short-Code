<?php
namespace App\Services;

use App\Contracts\RpcServer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Contracts\ControllerDispatcher;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Validation\ValidationException;

class JsonRpcServer implements RpcServer
{
    private const JSON_RPC_VERSION = "2.0";
    private const NAMESPACE = "App\\Http\\Controllers";

    private $routes;

    private $request;
    private $controller_dispatcher;

    public function __construct($app)
    {
        $this->app = $app;
        $this->request = $app->make(Request::class);
        $this->controller_dispatcher = $app->make(ControllerDispatcher::class);

        $this->routes = collect([]);
    }

    public function register(string $method, string $class)
    {
        $this->routes->push(["method" => $method, "class" => $class]);
    }

    public function handle(): array
    {
        if ($this->request->json()->count() === 0) {
            return $this->error([
                "code" => -32700,
                "message" => "Parse error"
            ]);
        }

        $validator = $this->validator($this->request->all());

        if ($validator->fails()) {
            return $this->error([
                "code" => -32600,
                "message" => "Invalid Request"
            ]);
        }

        $id = $this->request->id;

        $route = $this->routes->firstWhere("method", $this->request->method);

        if ($route === null) {
            return $this->error([
                "code" => -32601,
                "message" => "Method not found"
            ], $id);
        }

        [$class, $method] = explode("@", $route["class"]);

        $controller = $this->app->make(Self::NAMESPACE . "\\" . $class);

        $this->request->replace($this->request->params);

        try {
            $result = $this->controller_dispatcher->dispatch(Route::current(), $controller, $method);

            return $this->result($result, $id);
        } catch (ValidationException $e) {
            return $this->error([
                "code" => -32602,
                "message" => "Invalid params"
            ], $id);
        } catch (\Exception $e) {
            report($e);

            return $this->error([
                "code" => -32603,
                "message" => "Internal error"
            ]);
        }
    }

    private function validator(array $data)
    {
        return Validator::make($data, [
            "jsonrpc" => ["required", Rule::in([Self::JSON_RPC_VERSION])],
            "method" => ["required", "string"],
            "params" => ["required", "array"],
            "id" => ["required", "integer"]
        ]);
    }

    private function error($error, $id = null)
    {
        return [
            "jsonrpc" => Self::JSON_RPC_VERSION,
            "error" => $error,
            "id" => $id
        ];
    }

    private function result($result, $id)
    {
        return [
            "jsonrpc" => Self::JSON_RPC_VERSION,
            "result" => $result,
            "id" => $id
        ];
    }
}