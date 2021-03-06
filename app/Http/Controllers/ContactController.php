<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacts;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.role:read', ['only' => ['index', 'show']]);
        $this->middleware('auth.role:add', ['only' => ['store']]);
        $this->middleware('auth.role:delete', ['only' => ['update', 'destroy']]);
    }

    private $validatorParams = [
        'name' => 'required|max:255',
        'email' => 'email',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contacts::orderBy('name', 'asc')->get();

        return response(["data" => $contacts], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, $this->validatorParams);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $contact = Contacts::create($data);

        return response(['data' => $contact, 'message' => 'Created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contacts::find($id);
        if (!$contact) {
            return response(['error' => "not found"], 404);
        }

        return response(['data' => $contact, 'message' => 'Retrieved successfully'], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, $this->validatorParams);
        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
        $contact = Contacts::find($id);
        if (!$contact) {
            return response(['error' => "not found"], 404);
        }

        $contact->update($request->all());

        return response(['data' => $contact, 'message' => 'Update successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Contacts::find($id)) {
            return response(['error' => "not found"], 404);
        }

        Contacts::destroy($id);


        return response(['message' => 'Deleted']);
    }
}
