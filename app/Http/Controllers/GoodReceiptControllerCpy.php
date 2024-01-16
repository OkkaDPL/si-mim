<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lot;
use App\Models\Part;
use Illuminate\Support\Facades\DB;
use App\Models\Inventory;
use App\Models\GoodReceipt;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;

class GoodReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'dashboard.transaksi.goodreceipt.mgoodreceipt',
            [
                "title" => 'Data Good Receipts',
                "subTitle" => 'Transaksi',
                "goodreceipts" => GoodReceipt::with('purchaseOrder')->get(),
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
        // $purchaseOrders = PurchaseOrder::with('principal', 'purchaseOrderItem')->whereNotIn('id', GoodReceipt::pluck('purchaseorder_id')->toArray())->get();
        $purchaseOrders = PurchaseOrder::with('principal', 'purchaseOrderItem')->whereNotIn('id', GoodReceipt::pluck('purchaseorder_id')->toArray())->get();
        $parts = Part::with('uom')->get();
        $lots = Lot::all();

        return view('dashboard.transaksi.goodreceipt.fgoodreceipt', [
            "title" => 'Form Goods Receipt',
            "subTitle" => 'Transaksi',
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
    public function store(Request $request, PurchaseOrder $purchaseorder)
    {
        $validatedData = $request->validate([
            'purchaseorder_id' => ['required', 'exists:purchase_orders,id'],
            'tanggal' => ['required', 'date'],
            'part_id.*' => ['required', 'exists:parts,id'],
            'lot_id.*' => ['required', 'exists:lots,id'],
            'qty.*' => ['required', 'min:1'],
            'warehouse_id.*' => ['required', 'exists:warehouses,id'],
            'bin_id.*' => ['required', 'exists:bins,id'],
        ]);
        // dd($validatedData);

        $goodReceipt = GoodReceipt::create([
            'purchaseorder_id' => $validatedData['purchaseorder_id'],
            'tanggal' => $validatedData['tanggal'],
            'user_id' => Auth::id()
        ]);
        // dd($goodReceipt);

        $waktu = Carbon::now();
        $invenArr = [];
        foreach ($validatedData['part_id'] as $index => $partId) {
            $invenArr[] = [
                // 'goodreceipt_id' => $goodReceipt->id,
                'part_id' => $partId,
                'qty' =>  str_replace(",", "", $validatedData['qty'][$index]),
                'lot_id' => $validatedData['lot_id'][$index],
                'warehouse_id' => $validatedData['warehouse_id'][$index],
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ];
        }
        // dd($invenArr);
        Inventory::insert($invenArr);
        return redirect('/dashboard/goodreceipts')->with('success', 'The new data has been successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GoodReceipt  $goodReceipt
     * @return \Illuminate\Http\Response
     */
    public function show(GoodReceipt $goodReceipt)
    {
        //
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
            ->where('purchaseorder_id', '=', $request->id)
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
                    <input type="text" class="form-control" id="namabarang" name="namabarang[]" value="' . $part->nama . '" required disabled>
                </td>
                <td>
                    <input name="nama[]" type="text" class="form-control input-border-bottom desc-input" disabled
                        value="' . $part->nama . '">
                </td>
                <td>
                    <input name="uomm[]" type="text" class="form-control input-border-bottom uom-input" disabled
                        value="' . $uom->nama . '">
                </td>
                <td>
                <input id="qty" name="qty[]" type="text" class="form-control input-border-bottom" required value="' . $i->qty . '">
                    <input id="warehouse_id" name="warehouse_id[]" type="text" class="form-control input-border-bottom "
                         value="1" hidden>
                </td>
                <td>
                    <select class="form-control lot-select" id="lot_id" name="lot_id[]" required>
                        <option value="">-- Pilih Lot --</option>');

                foreach ($lots as $lot) {
                    echo '<option value="' . $lot->id . '">' . $lot->kd_lots . '</option>';
                }
                '</select>
                </td>
            </tr>';
            }
        } else {
            echo ('<option value="">-- Datas not found --</option>');
        }
    }
}
