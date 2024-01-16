<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Warehouse;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use App\Models\DeliveryOrder;
use App\Models\DeliveryOrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DeliveryOrderExport;

class DeliveryOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', DeliveryOrder::class);
        return view(
            'dashboard.warehousemanagement.deliveryorder.mdeliveryorder',
            [
                "title" => 'Data Delivery Orders',
                "subTitle" => 'wms',
                "deliveryOrder" => DeliveryOrder::with('salesOrder', 'warehouse', 'customer', 'bin')->get()
            ]
        );
    }
    public function getExcel()
    {
        return Excel::download(new DeliveryOrderExport, 'deliveryorder.xlsx');
    }
    public function getPdf($idDO)
    {
        return view('dashboard.warehousemanagement.deliveryorder.deliveryorderPDF', [
            "title" => "Delivery Order",
            "deliveryOrder" => DeliveryOrder::with('salesOrder', 'warehouse', 'customer', 'bin', 'deliveryOrderItem')->where('id_deliveryOrder', $idDO)->first(),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('viewAny', DeliveryOrder::class);
        return view(
            'dashboard.warehousemanagement.deliveryorder.fdeliveryorder',
            [
                "title" => 'Form Delivery Orders',
                "subTitle" => 'wms',
                // "salesOrders" => SalesOrder::with('warehouse', 'customer', 'bin')->get(),
                "salesOrders" => SalesOrder::with('warehouse', 'customer', 'bin')->WhereNotIn('id', DeliveryOrder::pluck('salesOrder_id')->toArray())->get(),
                "warehouses" => Warehouse::all(),
                "customers" => Customer::where('id', '>', 1)->get()
            ]
        );
    }

    public function getItemSo(Request $request)
    {

        // echo ($request->valSo);
        $doItems = DB::table('sales_order_items')
            ->where('salesOrder_id', '=', $request->valSo)
            ->orderBy('salesOrder_id', 'asc')
            ->get();

        $jml_item = $doItems->count();

        if ($jml_item > 0) {

            foreach ($doItems as $i) {
                $inventory = DB::table('inventories')
                    ->where('id', $i->inventory_id)
                    ->first();

                $part = DB::table('parts')
                    ->where('id', $inventory->part_id)
                    ->first();

                $uom = DB::table('uoms')
                    ->where('id', $part->uom_id)
                    ->first();

                $lot = DB::table('lots')
                    ->where('id', $inventory->lot_id)
                    ->first();

                echo ('<tr>
                <td>
                    <select class="form-control" name="salesOrderItem_id[]" required readonly>
                    <option value="' . $i->id . '"> ' . $part->kd_parts . '
                    </option>
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control" name="namaParts[]" value="' . $part->nama . '" required readonly>
                </td>
                <td>
                    <input type="text" class="form-control" name="namaUom[]" value="' . $uom->nama . '" required readonly>
                </td>
                <td>
                    <input type="text" class="form-control" name="qty[]" value="' . $i->qty . '" required readonly>
                </td>
                <td>
                    <input type="text" class="form-control" name="lot[]" value="' . $lot->kd_lots . '" required readonly>
                </td>
                <td>
                    <input type="text" class="form-control" name="expD[]" value="' . $lot->exp . '" required readonly>
                </td>
            </tr>');
            }
        } else {
            echo ('<option value="">-- Datas not found --</option>');
        }
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
            'salesOrder_id' => ['required', 'exists:sales_orders,id'],
            'shipdate' => ['required', 'date'],
            // 'warehouse_id' => ['required', 'exists:warehouses,id'],
            // 'customer_id' => ['required', 'exists:customers,id'],
            'note' => ['required'],
            'salesOrderItem_id.*' => ['required', 'exists:sales_order_items,id'],
        ]);
        // dd($validatedData);
        $salesOrderId = $validatedData['salesOrder_id'];
        $salesOrder = SalesOrder::find($salesOrderId);
        $salesOrder->update([
            'status' => 'On Delivery'
        ]);

        $deliveryOrder = DeliveryOrder::create([
            'salesOrder_id' => $validatedData['salesOrder_id'],
            'tanggal' => $validatedData['shipdate'],
            // 'warehouse_id' => $validatedData['warehouse_id'],
            // 'customer_id' => $validatedData['customer_id'],
            'note' => $validatedData['note'],
            'status' => 'Process',
            'user_id' => Auth::id()
        ]);
        $waktu = Carbon::now();
        if ($deliveryOrder) {
            foreach ($validatedData['salesOrderItem_id'] as $index => $soItemId) {
                $soItemArr[] = [
                    'salesOrderItem_id' => $soItemId,
                    'deliveryOrder_id' => $deliveryOrder->id,
                    'created_at' => $waktu,
                    'updated_at' => $waktu,
                ];
            }
        }
        DeliveryOrderItem::insert($soItemArr);

        return redirect('/dashboard/deliveryorders')->with('success', 'The new data has been successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeliveryOrder  $deliveryOrder
     * @return \Illuminate\Http\Response
     */
    public function show($getId)
    {
        $this->authorize('viewAny', DeliveryOrder::class);
        return view('dashboard.warehousemanagement.deliveryorder.sdeliveryorder', [
            "title" => 'Detail Delivery Order',
            "subTitle" => 'wms',
            "deliveryOrder" => DeliveryOrder::with('salesOrder', 'warehouse', 'customer', 'bin', 'deliveryOrderItem')->find($getId),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeliveryOrder  $deliveryOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryOrder $deliveryOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliveryOrder  $deliveryOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryOrder $deliveryOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryOrder  $deliveryOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryOrder $deliveryOrder)
    {
        //
    }
}
