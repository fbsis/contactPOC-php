<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configs;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $onDeletecontacts = Configs::all()->pluck('value', 'key');
        return response(
            ["data" => $onDeletecontacts],
            200
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $configs = Configs::where("key", "onDeletecontacts")->first();

        $configs->value = $data["onDeletecontacts"];

        $configs->save();

        return response(['data' => $configs, 'message' => 'Update successfully'], 200);
    }
}
