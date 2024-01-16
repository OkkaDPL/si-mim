<?php

namespace App\Http\Controllers;

use App\Exports\InvoiceExport;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Warehouse;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use App\Models\DeliveryOrder;
use App\Models\SalesOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Invoice::class);
        return view('dashboard.billing.invoice.minvoice', [
            "title" => 'Data Invoice',
            "subTitle" => 'billing',
            "invoice" => Invoice::with('deliveryOrder')->get()
        ]);
    }

    public function getExcel()
    {
        return Excel::download(new InvoiceExport, 'invoices.xls');
    }
    public function getPdf($getId)
    {
        return view('dashboard.billing.invoice.invoicePDF', [
            "title" => 'Invoice',
            "invoice" => Invoice::with('deliveryOrder', 'invoiceItem')->where('id_invoice', $getId)->first()
        ]);
    }
    public function getKwtPdf($getId)
    {
        return view('dashboard.billing.invoice.kwtPDF', [
            "title" => 'Kwitansi',
            "invoice" => Invoice::with('deliveryOrder', 'invoiceItem')->where('id_invoice', $getId)->first()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('viewAny', Invoice::class);
        return view('dashboard.billing.invoice.finvoice', [
            "title" => 'Form Invoice',
            "subTitle" => 'billing',
            "deliveryOrder" => DeliveryOrder::with('salesOrder', 'warehouse', 'customer')->whereNotIn('id', Invoice::pluck('deliveryOrder_id'))->get(),
            // "deliveryOrder" => DeliveryOrder::with('salesOrder', 'warehouse', 'customer')->get(),
            "warehouses" => Warehouse::all(),
            "customers" => Customer::all()
        ]);
    }
    public function itemInvoice(Request $request)
    {
        $deliveryOrderItems = DB::table('delivery_order_items')
            ->where('deliveryOrder_id', '=', $request->valDo)
            ->orderBy('id', 'asc')
            ->get();

        foreach ($deliveryOrderItems as $i) {
            $salesOrderItems = DB::table('sales_order_items')
                ->where('id', '=', $i->salesOrderItem_id)
                ->orderBy('id', 'asc')
                ->first();

            $inventory = DB::table('inventories')
                ->where('id', '=', $salesOrderItems->inventory_id)
                ->orderBy('id', 'asc')
                ->first();

            $part = DB::table('parts')
                ->where('id', '=', $inventory->part_id)
                ->orderBy('id', 'asc')
                ->first();

            $uom = DB::table('uoms')
                ->where('id', '=', $part->uom_id)
                ->orderBy('id', 'asc')
                ->first();

            echo ('
                    <tr>
                        <td>
                            <input name="deliveryOrderItem_id[]" class="form-control" value="' . $i->id . '" hidden>
                            <input name="part[]" class="form-control" value="' . $part->kd_parts . '" readonly>
                        </td>
                        <td>
                            <input name="partDesc[]" class="form-control" value="' . $part->nama . '" readonly>
                        </td>
                        <td>
                            <input name="uom[]" class="form-control" value="' . $uom->nama . '" readonly>
                        </td>
                        <td>
                            <input name="qty[]" class="form-control" value="' . $salesOrderItems->qty . '" readonly>
                        </td>
                        <td>
                        <input name="hargasat[]" class="form-control" value="' . number_format($salesOrderItems->hargasat, 2, ',', '.') . '" readonly>
                        </td>
                        <td>
                            <input name="hargatot[]" class="form-control" value="' . number_format($salesOrderItems->hargatot, 2, ',', '.') . '" readonly>
                        </td>
                    </tr>'
            );
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
            'deliveryOrder_id' => ['required', 'exists:delivery_orders,id'],
            'deliveryOrderItem_id.*' => ['required', 'exists:delivery_order_items,id']
        ]);

        // dd($validatedData);
        $deliveryOrderId = $validatedData['deliveryOrder_id'];
        $deliveryOrder = DeliveryOrder::find($deliveryOrderId);
        $deliveryOrder->update([
            'status' => 'Invoiced'
        ]);

        $salesOrder = SalesOrder::where('id', '=', $deliveryOrder->id);
        $salesOrder->update([
            'status' => 'Invoiced'
        ]);
        $invoice = Invoice::create([
            'deliveryOrder_id' => $validatedData['deliveryOrder_id'],
            'user_id' => Auth::id(),
        ]);

        foreach ($validatedData['deliveryOrderItem_id'] as $index => $deliveryOrderItemId) {
            $invoiceItems = InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'deliveryOrderItem_id' => $deliveryOrderItemId,
            ]);
            // dd($salesOrderItem);
        }
        return redirect('/dashboard/invoice')->with('success', 'The new data has been successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($getId)
    {
        $this->authorize('viewAny', Invoice::class);
        return view('dashboard.billing.invoice.sinvoice', [
            "title" => 'Detail Invoice',
            "subTitle" => 'billing',
            "invoice" => Invoice::with('deliveryOrder', 'invoiceItem')->find($getId),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
