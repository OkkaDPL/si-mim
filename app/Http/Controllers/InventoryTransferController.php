<?php

namespace App\Http\Controllers;

use App\Models\Bin;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\InventoryMovement;
use App\Models\InventoryTransfer;
use App\Models\InventoryTransferItem;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InventoryTransferExport;

class InventoryTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', InventoryTransfer::class);
        return view(
            'dashboard.warehousemanagement.inventorytransfer.minventorytransfer',
            [
                "title" => 'Data Inventory Transfer',
                "subTitle" => 'wms',
                "inventorytransfer" => InventoryTransfer::with('user', 'fromBin', 'toBin')->get()
            ]
        );
    }

    public function getExcel()
    {
        return Excel::download(new InventoryTransferExport, 'inventorytransfer.xlsx');
    }
    public function getPdf($getId)
    {
        return view('dashboard.warehousemanagement.inventorytransfer.inventorytransferPDF', [
            "title" => 'Inventory Transfer',
            "inventoryTransfer" => InventoryTransfer::with('user', 'fromBin', 'toBin')->where('id_inventoryTransfer', $getId)->first()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('viewAny', InventoryTransfer::class);
        return view('dashboard.warehousemanagement.inventorytransfer.finventorytransfer', [
            "title" => 'Form Inventory Transfer',
            "subTitle" => 'wms',
            "bins" => Bin::whereIn('id', Inventory::where('qty', '>', 0)->pluck('bin_id')->toArray())->with('customer')->get(),
            "rBins" => Bin::all(),
            "inventory" => Inventory::all()
        ]);
    }

    public function triggedBin(Request $request)
    {
        $dataInvenTriggedBin["inventoryTriggedBin"] = Inventory::with('part.uom', 'lot')
            ->where('bin_id', '=', $request->get_bin)
            ->where('qty', '>', 0)
            ->orderBy('part_id', 'asc')
            ->get();

        return response()->json($dataInvenTriggedBin);
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
            'fromBin_id' => ['required', 'exists:bins,id'],
            'toBin_id' => ['required', 'exists:bins,id'],
            'part_id' => ['required', 'exists:parts,id'],
            'bin_id' => ['required', 'exists:bins,id'],
            'lot_id' => ['required', 'exists:lots,id'],
            'shipdate' => ['required', 'date'],
            'note' => ['required'],
            'bin_id.*' => ['required', 'exists:bins,id'],
            'inventory_id.*' => ['required', 'exists:inventories,id'],
            'qty.*' => ['required', 'min:0', 'lte:fakeQty.*'],
            'fakeQty.*' => ['required', 'min:0'],
        ]);

        // dd($validatedData);
        $inventoryTransfer = InventoryTransfer::create([
            'shipdate' => $validatedData['shipdate'],
            'user_id' => Auth::id(),
            'fromBin_id' => $validatedData['fromBin_id'],
            'toBin_id' => $validatedData['toBin_id'],
            'note' => $validatedData['note'],
        ]);

        $waktu = Carbon::now();
        $invenArr = [];
        foreach ($validatedData['inventory_id'] as $index => $inventoryId) {
            $inventoryTransferItem = InventoryTransferItem::create([
                'inventoryTransfer_id' => $inventoryTransfer->id,
                'inventory_id' => $inventoryId,
                'qty' => $validatedData['qty'][$index],
            ]);
            // dd($inventoryTransferItem);

            $inventory = Inventory::where('id', $request->inventory_id[$index])
                ->where('bin_id', $request->fromBin_id)
                ->first();

            InventoryMovement::create([
                'inventory_id' => $inventoryId,
                'qty' => $validatedData['qty'][$index],
                'doc' => $inventoryTransfer->id_inventoryTransfer,
                'from' => 'Inventory Transfer'
            ]);

            // dd($inventory);
            if ($inventory) {
                $inventory->update([
                    'qty' => $inventory->qty - $validatedData['qty'][$index],
                    'updated_at' => $waktu,
                ]);
                $cekInventory = Inventory::where('part_id', $request->part_id[$index])
                    ->where('lot_id', $request->lot_id[$index])
                    ->where('bin_id', $request->bin_id[$index])
                    ->first();

                if ($cekInventory) {
                    $cekInventory->update([
                        'qty' => $cekInventory->qty + $validatedData['qty'][$index],
                        'updated_at' => $waktu,
                    ]);
                } else {
                    $invenArr[] = [
                        'part_id' => $validatedData['part_id'][$index],
                        'qty' => str_replace(",", "", $validatedData['qty'][$index]),
                        'lot_id' => $validatedData['lot_id'][$index],
                        'warehouse_id' => 1,
                        'bin_id' => $validatedData['bin_id'][$index],
                        'created_at' => $waktu,
                        'updated_at' => $waktu,
                    ];
                    Inventory::insert($invenArr);
                }
            }
        }
        return redirect('/dashboard/inventorytransfer')->with('success', 'The new data has been successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InventoryTransfer  $inventoryTransfer
     * @return \Illuminate\Http\Response
     */
    public function show($getId)
    {
        $this->authorize('viewAny', InventoryTransfer::class);
        return view('dashboard.warehousemanagement.inventorytransfer.sinventorytransfer', [
            "title" => 'Inventory Transfer Detail',
            "subTitle" => 'wms',
            "inventoryTransfer" => InventoryTransfer::with('user', 'inventory', 'fromBin', 'toBin')->find($getId),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InventoryTransfer  $inventoryTransfer
     * @return \Illuminate\Http\Response
     */
    public function edit(InventoryTransfer $inventoryTransfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InventoryTransfer  $inventoryTransfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InventoryTransfer $inventoryTransfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InventoryTransfer  $inventoryTransfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(InventoryTransfer $inventoryTransfer)
    {
        //
    }
}
