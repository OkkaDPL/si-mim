<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bin;
use App\Models\User;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Inventory;
use App\Models\InventoryMovement;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use App\Models\SalesOrderItem;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesOrderExport;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', SalesOrder::class);
        return view(
            'dashboard.transaksi.salesorder.msalesorder',
            [
                "title" => 'Data Sales Orders',
                "subTitle" => 'Transaksi',
                "salesOrders" => SalesOrder::with('employee', 'customer', 'salesOrderItem')->get(),
            ]
        );
    }
    public function getExcel()
    {
        return Excel::download(new SalesOrderExport, 'salesorders.xlsx');
    }
    public function getPdf($getId)
    {
        return view('dashboard.transaksi.salesorder.salesorderPDF', [
            "title" => 'Sales Order',
            "salesOrders" => SalesOrder::with('employee', 'customer', 'salesOrderItem')->where('id_salesOrder', $getId)->first(),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //filter user dengan query
        // $user = User::where('departement', '=', 'Sales')->get();
        // if ($user->count() > 0) {
        //     foreach ($user as $i) {
        //         $getSales[] = $i->id;
        //     }
        //     $ambilEmployee = Employee::whereIn('user_id', $getSales)->get();
        // } else {
        //     $ambilEmployee = [];
        // }
        // return $user;

        // return $getSales->count();
        $this->authorize('viewAny', SalesOrder::class);
        return view('dashboard.transaksi.salesorder.fsalesorder', [
            "title" => 'Form Sales Order',
            "subTitle" => 'Transaksi',
            "customers" => Customer::where('id', '>', 1)->get(),
            "bins" => Bin::whereIn('id', Inventory::where('qty', '>', 0)->pluck('bin_id')->toArray())->with('customer')->get(),
            "employees" => Employee::whereIn('user_id', User::where('departement', '=', 'Sales')->pluck('id')->toArray())->get()
            // "employees" => $ambilEmployee //ambil filter user dengan query
        ]);
    }

    public function triggedStockOn(Request $request)
    {
        $dataInvenTriggedStockOn["InventoryTriggedStockOn"] = Inventory::with('part.uom', 'lot')
            ->where('bin_id', '=', $request->getInventoryId)->where('qty', '>', 0)
            ->orderBy('part_id', 'asc')
            ->get();

        return response()->json($dataInvenTriggedStockOn);
    }
    public function getCustomer(Request $request)
    {
        $bin = Bin::where('id', '=', $request->getCustomer)->first();

        $customerIdByBin = $bin->customer_id;

        if ($customerIdByBin != 1) {
            $customer["getArrCust"] = Customer::where('id', '=', $customerIdByBin)->get();
        } else {
            $customer["getArrCust"] = Customer::where('id', '>', 1)->orderBy('id', 'asc')->get();
        }

        return response()->json($customer);
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
            'employee_id' => ['required', 'exists:employees,id'],
            'tanggal' => ['required', 'date'],
            'sih' => ['mimes:pdf', 'file', 'max:1024'],
            'pofile' => ['mimes:pdf', 'file', 'max:1024'],
            'po' => ['required'],
            'bin_id' => ['required', 'exists:bins,id'],
            'customer_id' => ['required', 'exists:customers,id'],
            'inventory_id.*' => ['required', 'exists:inventories,id'],
            'qty.*' => ['required', 'min:1'],
            'hargasat.*' => ['required'],
            'hargatot.*' => ['required'],
            'amount' => ['required'],
            'ppn' => ['required'],
            'gtotal' => ['required'],
            'note' => ['required'],
        ]);
        // dd($validatedData);
        $salesOrder = SalesOrder::create([
            'tanggal' => $validatedData['tanggal'],
            'po' => $validatedData['po'],
            'note' => $validatedData['note'],
            'customer_id' => $validatedData['customer_id'],
            'bin_id' => $validatedData['bin_id'],
            'employee_id' => $validatedData['employee_id'],
            'pofile' => $validatedData['pofile']->store('po-file'),
            'sih' => $validatedData['sih']->store('sih'),
            'status' => 'Process',
            'user_id' => Auth::id(),
            'warehouse_id' => 1,
            'amount' => str_replace(",", "", $validatedData['amount']),
            'ppn' => str_replace(",", "", $validatedData['ppn']),
            'gtotal' => str_replace(",", "", $validatedData['gtotal']),
        ]);

        $waktu = Carbon::now();
        foreach ($validatedData['inventory_id'] as $index => $inventoryId) {
            $salesOrderItem = SalesOrderItem::create([
                'salesOrder_id' => $salesOrder->id,
                'inventory_id' => $inventoryId,
                'qty' => $validatedData['qty'][$index],
                'hargasat' => str_replace(",", "", $validatedData['hargasat'][$index]),
                'hargatot' => str_replace(",", "", $validatedData['hargatot'][$index]),
            ]);
            // dd($salesOrderItem);

            $inventory = Inventory::where('id', $request->inventory_id[$index])
                ->first();

            // dd($inventory);
            if ($inventory) {
                $inventory->update([
                    'qty' => $inventory->qty - $validatedData['qty'][$index],
                    'updated_at' => $waktu,
                ]);
                InventoryMovement::create([
                    'inventory_id' => $inventory->id,
                    'qty' => $validatedData['qty'][$index],
                    'doc' => $salesOrder->id_salesOrder,
                    'from' => 'Sales Order'
                ]);
            }
        }
        return redirect('/dashboard/salesorders')->with('success', 'The new data has been successfully added!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function show($getId)
    {
        $this->authorize('viewAny', SalesOrder::class);
        return view('dashboard.transaksi.salesorder.ssalesorder', [
            "title" => 'Detail Sales Order',
            "subTitle" => 'Transaksi',
            "salesOrder" => SalesOrder::with('user', 'bin', 'employee', 'customer', 'warehouse', 'salesOrderItem')->find($getId),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesOrder $salesOrder)
    {
        //
    }
}
