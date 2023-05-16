<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Address;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var Address $address */
        $addresses = Address::all();

        return response()->json(['addresses' => $addresses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'streetName'       => 'required',
            'buildingNumber'   => 'required|numeric',
            'neighborhood'     => 'required',
            'city'             => 'required',
            'state'            => 'required',
            'postcode'         => 'required|numeric',
            'customerId'       => 'required|numeric'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return response()->json(
                [
                    'message' => 'Can not is possible save the address',
                    'errors'  => $errors
                ]
            );
        }

        /** @var Address $address */
        $address = Address::create($request->all());

        return redirect()->route('addresses.show', ['address' => $address]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $address = Address::find($id);
        return response()->json($address);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
