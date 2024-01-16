<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryMovement;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InventoryMovementExport;

class InventoryMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.warehousemanagement.inventorymovement.minventorymovement', [
            "title" => 'Data Inventory Movement',
            "subTitle" => 'wms',
            "inventorymovement" => InventoryMovement::with('inventory')->get(),
        ]);
    }
    public function getExcel()
    {
        return Excel::download(new InventoryMovementExport, 'inventorymovement.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InventoryMovement  $inventoryMovement
     * @return \Illuminate\Http\Response
     */
    public function show(InventoryMovement $inventoryMovement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InventoryMovement  $inventoryMovement
     * @return \Illuminate\Http\Response
     */
    public function edit(InventoryMovement $inventoryMovement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InventoryMovement  $inventoryMovement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InventoryMovement $inventoryMovement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InventoryMovement  $inventoryMovement
     * @return \Illuminate\Http\Response
     */
    public function destroy(InventoryMovement $inventoryMovement)
    {
        //
    }
}
