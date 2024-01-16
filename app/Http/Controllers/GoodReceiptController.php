<?php

namespace App\Http\Controllers;

use App\Exports\GoodReceiptExport;
use Carbon\Carbon;
use App\Models\Lot;
use App\Models\Part;
use App\Models\Inventory;
use App\Models\Warehouse;
use App\Models\GoodReceipt;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\GoodReceiptItem;
use App\Models\InventoryMovement;
use App\Models\PurchaseOrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class GoodReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', GoodReceipt::class);
        return view(
            'dashboard.warehousemanagement.goodreceipt.mgoodreceipt',
            [
                "title" => 'Data Good Receipts',
                "subTitle" => 'wms',
                "goodreceipts" => GoodReceipt::orderBy('id_goodreceipt', 'asc')->with('purchaseOrder')->get(),
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
        $this->authorize('viewAny', GoodReceipt::class);
        $purchaseOrders = PurchaseOrder::with('principal', 'purchaseOrderItem')
            ->where('status', '=', 'Approved')
            ->whereNotIn('id', GoodReceipt::pluck('purchaseorder_id')->toArray())
            ->get();
        // $purchaseOrders = PurchaseOrder::all();
        $parts = Part::with('uom')->get();
        $lots = Lot::all();

        return view('dashboard.warehousemanagement.goodreceipt.fgoodreceipt', [
            "title" => 'Form Goods Receipt',
            "subTitle" => 'wms',
            "purchaseorder" => $purchaseOrders,
            "parts" => $parts,
            "lots" => $lots,
            "warehouses" => Warehouse::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Inventory $inventory)
    {
        $validatedData = $request->validate([
            'purchaseorder_id' => ['required', 'exists:purchase_orders,id'],
            'tanggal' => ['required', 'date'],
            'suratjalan' => ['required'],
            'note' => ['required'],
            'part_id.*' => ['required', 'exists:parts,id'],
            'lot_id.*' => ['min:0'],
            'qty.*' => ['required', 'numeric', 'lte:fakeQty.*', 'gte:0'],
            'fakeQty.*' => ['required', 'min:1'],
            'warehouse_id.*' => ['required', 'exists:warehouses,id'],
            'bin_id.*' => ['required', 'exists:bins,id'],
        ]);
        $purchaseOrderId = $validatedData['purchaseorder_id'];
        $purchaseOrder = PurchaseOrder::find($purchaseOrderId);
        $purchaseOrder->update([
            'status' => 'Received'
        ]);
        $goodReceipt = GoodReceipt::create([
            'purchaseorder_id' => $validatedData['purchaseorder_id'],
            'tanggal' => $validatedData['tanggal'],
            'suratjalan' => $validatedData['suratjalan'],
            'note' => $validatedData['note'],
            'user_id' => Auth::id()
        ]);
        $purchaseOrderItem = PurchaseOrderItem::where('purchaseorder_id', $purchaseOrderId)->get();
        $waktu = Carbon::now();
        foreach ($validatedData['part_id'] as $index => $partId) {
            if ($validatedData['qty'][$index] != $validatedData['fakeQty'][$index]) {
                foreach ($purchaseOrderItem as $poI) {
                    $idPoI[] = $poI->id;
                }
                $updateHargaPoI = PurchaseOrderItem::where('id', $idPoI[$index])->first();
                if ($updateHargaPoI) {
                    $updateHargaPoI->update([
                        'qty' => $validatedData['qty'][$index],
                        'hargatot' => $validatedData['qty'][$index] * $updateHargaPoI->hargasat,
                    ]);
                    $newHargaPoI = PurchaseOrderItem::where('purchaseorder_id', $purchaseOrderId)->sum('hargatot');
                    $newHargaPo = PurchaseOrder::where('id', $purchaseOrderId)->update([
                        'amount' => $newHargaPoI,
                        'ppn' => $newHargaPoI * 0.11,
                        'gtotal' => $newHargaPoI + ($newHargaPoI * 0.11),
                    ]);
                }
                // dd($updateHargaPoI);
            }

            if ($validatedData['qty'][$index] > 0) {
                $goodReceiptItem = GoodReceiptItem::create([
                    'goodReceipt_id' => $goodReceipt->id,
                    'part_id' => $validatedData['part_id'][$index],
                    'qty' => $validatedData['qty'][$index],
                    'lot_id' => $validatedData['lot_id'][$index],
                ]);
            }
            $inventory = Inventory::where('part_id', $request->part_id[$index])
                ->where('lot_id', $request->lot_id[$index])
                ->where('warehouse_id', $request->warehouse_id[$index])
                ->where('bin_id', $request->bin_id[$index])
                ->first();
            if ($inventory) {
                $inventory->update([
                    'qty' => $inventory->qty + $validatedData['qty'][$index],
                    'updated_at' => $waktu,
                ]);
                InventoryMovement::create([
                    'inventory_id' => $inventory->id,
                    'qty' => $validatedData['qty'][$index],
                    'from' => 'Good Receipt',
                    'doc' => $goodReceipt->id_goodreceipt,
                ]);
            } else {
                if ($validatedData['qty'][$index] > 0) {
                    $kocak = Inventory::create([
                        'part_id' => $partId,
                        'qty' => str_replace(",", "", $validatedData['qty'][$index]),
                        'lot_id' => $validatedData['lot_id'][$index],
                        'warehouse_id' => $validatedData['warehouse_id'][$index],
                        'bin_id' => $validatedData['bin_id'][$index],
                    ]);
                    // $invenArr[] = [
                    //     'part_id' => $partId,
                    //     'qty' => str_replace(",", "", $validatedData['qty'][$index]),
                    //     'lot_id' => $validatedData['lot_id'][$index],
                    //     'warehouse_id' => $validatedData['warehouse_id'][$index],
                    //     'bin_id' => $validatedData['bin_id'][$index],
                    //     'created_at' => $waktu,
                    //     'updated_at' => $waktu,
                    // ];
                    // Inventory::insert($invenArr);
                    InventoryMovement::create([
                        'inventory_id' => $kocak->id,
                        'qty' => $validatedData['qty'][$index],
                        'from' => 'Good Receipt',
                        'doc' => $goodReceipt->id_goodreceipt
                    ]);
                }
            }
        }

        return redirect('/dashboard/goodreceipts')->with('success', 'The new data has been successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GoodReceipt  $goodReceipt
     * @return \Illuminate\Http\Response
     */
    public function show($getId)
    {
        $this->authorize('viewAny', GoodReceipt::class);
        return view('dashboard.warehousemanagement.goodreceipt.sgoodreceipt', [
            "title" => 'Detail Good Receipt',
            "subTitle" => 'wms',
            "goodReceipt" => GoodReceipt::with('user', 'purchaseOrder', 'goodReceiptItem')->find($getId),
        ]);
    }

    public function getExcel()
    {
        return Excel::download(new GoodReceiptExport, 'goodreceipts.xlsx');
    }
    public function getPdf($getId)
    {
        // $goodReceipt = GoodReceipt::with('user', 'purchaseOrder', 'goodReceiptItem')->where('id_goodreceipt', $getId);

        // // Dump and die untuk memeriksa isi dari $goodReceipt
        // dd($goodReceipt);

        return view('dashboard.warehousemanagement.goodreceipt.goodreceiptPDF', [
            "title" => 'Good Receipt',
            "goodReceipt" => GoodReceipt::with('user', 'purchaseOrder', 'goodReceiptItem')->where('id_goodreceipt', $getId)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GoodReceipt  $goodReceipt
     * @return \Illuminate\Http\Response
     */
    public function edit(GoodReceipt $goodReceipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GoodReceipt  $goodReceipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoodReceipt $goodReceipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GoodReceipt  $goodReceipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoodReceipt $goodReceipt)
    {
        //
    }

    public function getDtlItemPO(Request $request)
    {
        $item = DB::table('purchase_order_items')
            ->where('purchaseorder_id', '=', $request->kocak)
            ->orderBy('purchaseorder_id', 'asc')
            ->get();

        $jml_item = $item->count();

        if ($jml_item > 0) {
            $lots = DB::table('lots')->get();

            foreach ($item as $i) {
                $part = DB::table('parts')
                    ->where('id', $i->part_id)
                    ->first();

                $uom = DB::table('uoms')
                    ->where('id', $part->uom_id)
                    ->first();

                $warehouse = DB::table('warehouses')
                    ->where('id', '=', $request->wh)
                    ->get();

                echo ('<tr>
                <td>
                    <input type="text" class="form-control part-select" id="part_id" name="part_id[]" value="' . $i->part_id . '" required hidden>
                    <input type="text" class="form-control" id="kdPart" name="kdPart[]" value="' . $part->kd_parts . '" required disabled>
                    <input id="warehouse_id" name="warehouse_id[]" type="text" class="form-control input-border-bottom"
                    value="1"  hidden>
                    <input id="bin_id" name="bin_id[]" type="text" class="form-control input-border-bottom" value="1" hidden>
                </td>
                <td>
                    <input name="nama[]" type="text" class="form-control input-border-bottom desc-input" disabled
                        value="' . $part->nama . '">
                </td>
                <td>
                    <input name="uom[]" type="text" class="form-control input-border-bottom uom-input" disabled
                        value="' . $uom->nama . '">
                </td>
                <td>
                <input name="qty[]" min="0" max="' . $i->qty . '" type="number" class="iQty form-control input-border-bottom" required value="' . $i->qty . '">
                <input name="fakeQty[]" type="text" class="form-control input-border-bottom" required value="' . $i->qty . '"" hidden>
                </td>
                <td>
                    <select class="form-control lotSelect" name="lot_id[]" >
                        <option value="">-- Pilih Lot --</option>');

                foreach ($lots as $lot) {
                    echo '<option value="' . $lot->id . '" data-exp="' . $lot->exp . '">' . $lot->kd_lots . '</option>';
                }
                echo ('</select>
                </td>
                <td><input class="iExp form-control input-border-bottom" id="lotDesc" name="lotDesc[]" value"" readonly></td>
            </tr>');
            }
        } else {
            echo ('<option value="">-- Datas not found --</option>');
        }
    }
}
