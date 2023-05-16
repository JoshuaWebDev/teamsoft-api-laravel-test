<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var Customer $customer */
        $customers = Customer::all();

        return response()->json(['customers' => $customers]);
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
            'cnpj'        => 'required|unique:customers',
            'razaoSocial' => 'required',
            'contactName' => 'required',
            'phoneNumber' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return response()->json(
                [
                    'message' => 'Can not is possible save the customer',
                    'errors'  => $errors
                ]
            );
        }

        /** @var Customer $customer */
        $customer = Customer::create($request->all());

        return redirect()->route('customers.show', ['customer' => $customer]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);
        return response()->json($customer);
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
