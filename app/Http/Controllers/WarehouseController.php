<?php

namespace App\Http\Controllers;

use App\Models\Bin;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Warehouse::class);
        return view(
            'dashboard.masterdata.warehouse.mwarehouse',
            [
                "title" => 'Data Warehouse',
                "subTitle" => 'MasterData',
                "warehouses" => Warehouse::all()
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
        $this->authorize('viewAny', Warehouse::class);
        return view(
            'dashboard.masterdata.warehouse.fwarehouse',
            [
                "title" => 'Form Warehouse',
                "subTitle" => 'MasterData',
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
        $validatedData = $request->validate([
            'nama' => 'required|max:50',
            'namaPt' => 'required|max:50',
            'alamat' => 'required|max:255',
        ]);
        // dd($validatedData);

        Warehouse::create($validatedData);

        return redirect('/dashboard/warehouses')->with('success', 'The new data has been successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        $this->authorize('viewAny', Warehouse::class);
        return view(
            'dashboard.masterdata.warehouse.ewarehouse',
            [
                "title" => 'Form Edit Warehouse',
                "subTitle" => 'MasterData',
                "warehouse" => $warehouse
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $rules = [];
        if ($request->nama != $warehouse->nama) {
            $rules['nama'] = 'required|max:50';
        }
        if ($request->alamat != $warehouse->alamat) {
            $rules['alamat'] = 'required|max:255';
        }

        $validatedData = $request->validate($rules);
        // $validatedData['user_id'] = auth()->user()->id;

        Warehouse::where('id', $warehouse->id)
            ->update($validatedData);
        return redirect('/dashboard/warehouses')->with('success', 'Data has been changed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        if ($warehouse->inventory()->count()) {
            return redirect('dashboard/warehouses')->with('error', 'Warehouse exist in another table, and cannot be deleted!');
        }
        Warehouse::destroy($warehouse->id);

        return redirect('dashboard/warehouses')->with('success', 'Data has been deleted!');
    }
}
