<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Http\Resources\Data as DataResource;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "title" => ["required", "string", "max:255"],
            "body" => ["required", "string"],
            "page_uid" => ["required", "uuid"]
        ]);

        return new DataResource(Data::create($request->all()));
    }

    public function show(Request $request)
    {
        $request->validate([
            "page_uid" => ["required", "uuid"]
        ]);

        return DataResource::collection(
            Data::where("page_uid", $request->page_uid)->orderBy('id', 'desc')->get()
        );
    }
}