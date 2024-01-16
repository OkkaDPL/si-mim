<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Customer::class);
        return view(
            'dashboard.masterdata.customer.mcustomer',
            [
                "title" => 'Data Customers',
                "subTitle" => 'MasterData',
                "customers" => Customer::all()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('viewAny', Customer::class);
        return view(
            'dashboard.masterdata.customer.fcustomer',
            [
                "title" => 'Form Customers',
                "subTitle" => 'MasterData',
                "customers" => Customer::all()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required|max:50',
            'tlp' => 'required|min:7|max:13',
            'email' => 'required|unique:customers|email:dns',
            'alamat' => 'required|max:255',
            'snpwp' => 'required|max:19',
        ];

        if ($request->snpwp === "Ya") {
            $rules['nonpwp'] = 'required|max:20';
        }
        $validatedData = $request->validate($rules);

        Customer::create($validatedData);

        return redirect('/dashboard/customers')->with('success', 'The new data has been successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $this->authorize('viewAny', Customer::class);
        return view(
            'dashboard.masterdata.customer.ecustomer',
            [
                "title" => 'Edit Data Customers',
                "subTitle" => 'MasterData',
                "customer" => $customer
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $rules = [];
        if ($request->nama != $customer->nama) {
            $rules['nama'] = 'required|max:50';
        }
        if ($request->tlp != $customer->tlp) {
            $rules['tlp'] = 'required|min:7|max:13';
        }
        if ($request->email != $customer->email) {
            $rules['email'] = 'required|email:dns|unique:customers';
        }
        if ($request->alamat != $customer->alamat) {
            $rules['alamat'] = 'required|max:255';
        }
        if ($request->snpwp != $customer->snpwp) {
            $rules['snpwp'] = 'required';
        }
        if ($request->snpwp === "Ya") {
            $rules['nonpwp'] = 'required|max:19';
        } else if ($request->nonpwp != $customer->nonpwp) {
            $rules['nonpwp'] = 'nullable|max:19';
        }

        $validatedData = $request->validate($rules);
        Customer::where('id', $customer->id)
            ->update($validatedData);
        return redirect('/dashboard/customers')->with('success', 'Data has been changed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        if ($customer->bin()->count()) {
            return redirect('dashboard/customers')->with('error', 'Customer exists in another table and cannot be deleted!');
        }

        Customer::destroy($customer->id);

        return redirect('dashboard/customers')->with('success', 'Data has been deleted!');
    }
}
