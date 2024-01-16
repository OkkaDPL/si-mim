<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\AdjustStock;
use Illuminate\Http\Request;
use App\Exports\InventoryExport;
use App\Models\InventoryMovement;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'dashboard.warehousemanagement.inventory.minventory',
            [
                "title" => 'Inventory',
                "subTitle" => 'wms',
                "inventories" => Inventory::orderBy('id', 'asc')->with('bin', 'warehouse', 'lot', 'part')->where('qty', '>', 0)->get()
            ]
        );
    }
    public function getExcel()
    {
        return Excel::download(new InventoryExport, 'inventories.xlsx');
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
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }
    public function adjStock($id)
    {
        $this->authorize('viewAny', Inventory::class);
        return view('dashboard.warehousemanagement.adjuststock.fadjstock', [
            "title" => 'Form Adjust Stock',
            "subTitle" => 'wms',
            "inventory" => Inventory::with('lot', 'part', 'bin')->where('id', $id)->first()
        ]);
    }
    public function updateAdjStock(Request $request, $id, AdjustStock $adjustStock)
    {
        $inventory = Inventory::where('id', $id)->first();
        $validatedData = $request->validate([
            'idInventory' => ['required'],
            'qty' => ['required', 'min:1'],
            'type' => ['required'],
            'note' => ['required'],
        ]);

        if ($validatedData['type'] === 'Adjust In') {
            $newQty = $inventory->qty + $validatedData['qty'];
            $updateInventory = Inventory::where('id', $id)->update([
                'qty' => $newQty
            ]);
            $adjStocks = AdjustStock::create([
                'id_inventory' => $id,
                'id_user' => Auth::id(),
                'qty' => $validatedData['qty'],
                'note' => $validatedData['note'],
                'status' => $validatedData['type'],
            ]);
            InventoryMovement::create([
                'inventory_id' => $id,
                'qty' => $validatedData['qty'],
                'from' => 'Adjust In',
                'doc' => $adjStocks->id_adjStock,
            ]);
        } else if ($validatedData['type'] === 'Adjust Out') {
            $newQty = $inventory->qty - $validatedData['qty'];
            $updateInventory = Inventory::where('id', $id)->update([
                'qty' => $newQty
            ]);
            $adjStocks = AdjustStock::create([
                'id_inventory' => $id,
                'id_user' => Auth::id(),
                'qty' => $validatedData['qty'],
                'note' => $validatedData['note'],
                'status' => $validatedData['type'],
            ]);
            InventoryMovement::create([
                'inventory_id' => $id,
                'qty' => $validatedData['qty'],
                'from' => 'Adjust Out',
                'doc' => $adjStocks->id_adjStock,
            ]);
        }
        return redirect('/dashboard/inventories')->with('success', 'Data has been successfully adjusted!');
        // dd($validatedData['type']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}
