<?php

namespace App\Http\Controllers;

use App\Contracts\RpcClient;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private const AVAILABLE_PAGES_UIDS = [
        "home" => "c9517253-975d-3877-8298-b7a8a8f5a0b5",
        "help" => "2b823c4e-0bb7-3a2b-8b42-a7da7d98c658"
    ];

    public function home() {
        return view("home", [
            "page_uid" => Self::AVAILABLE_PAGES_UIDS["home"]
        ]);
    }

    public function help() {
        return view("help", [
            "page_uid" => Self::AVAILABLE_PAGES_UIDS["help"]
        ]);
    }

    public function store(Request $request, RpcClient $client) {
        $request->validate([
            "page_uid" => ["required", "uuid", Rule::in(Self::AVAILABLE_PAGES_UIDS)],
            "title" => ["required", "string", "max:255"],
            "body" => ["required", "string"]
        ]);

        $client->call("store", $request->only(["page_uid", "title", "body"]));

        return redirect()->back();
    }
}