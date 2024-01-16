<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Part;
use App\Models\Principal;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Exports\PurchaseOrderExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class PurchaseOrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', PurchaseOrder::class);
        return view(
            'dashboard.finAcc.purchaseorder.mpurchaseorder',
            [
                "title" => 'Data Purchase Orders',
                "subTitle" => 'fna',
                "purchaseorder" => PurchaseOrder::with('user', 'principal', 'purchaseOrderItem')->get(),
            ]
        );
    }
    public function getExcel()
    {
        return Excel::download(new PurchaseOrderExport, 'purchaseorders.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('viewAny', PurchaseOrder::class);
        return view('dashboard.finAcc.purchaseorder.fpurchaseorder', [
            "title" => 'Form Purchase Order',
            "subTitle" => 'fna',
            "principals" => Principal::all(),
            "parts" => Part::with('uom')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'principal_id' => ['required', 'exists:principals,id'],
                'tglCreate' => ['required', 'date'],
                'tglExp' => ['required', 'date', 'after_or_equal:tglCreate'],
                'part_id.*' => ['required', 'exists:parts,id'],
                'nama.*' => ['required', 'exists:parts,nama'],
                'hargasat.*' => ['required', 'min:1'],
                'qty.*' => ['required', 'min:1',],
                'hargatot.*' => ['required', 'min:1'],
                'amount' => ['required', 'min:1'],
                'note' => ['required', 'min:1'],
                'pricelist' => ['mimes:pdf', 'file', 'max:1024'],
                'ppn' => ['required', 'min:1'],
                'gtotal' => ['required', 'min:1'],
            ],
            [
                'nama.*.exists' => 'Data not found',
                'pricelist.mimes' => 'Data harus berbentuk PDF'
            ]
        );

        // dd($validatedData);

        $purchaseOrder = PurchaseOrder::create([
            'tglCreate' => $validatedData['tglCreate'],
            'tglExp' => $validatedData['tglExp'],
            'note' => $validatedData['note'],
            'pricelist' => $validatedData['pricelist']->store('price-list'),
            'status' => 'Outstanding',
            'principal_id' => $validatedData['principal_id'],
            'user_id' => Auth::id(),
            'amount' => str_replace(",", "", $validatedData['amount']),
            'ppn' => str_replace(",", "", $validatedData['ppn']),
            'gtotal' => str_replace(",", "", $validatedData['gtotal']),
        ]);

        $waktu = Carbon::now();
        $itemsData = [];
        foreach ($validatedData['part_id'] as $index => $partId) {
            $itemsData[] = [
                'purchaseorder_id' => $purchaseOrder->id,
                'part_id' => $partId,
                'qty' =>  str_replace(",", "", $validatedData['qty'][$index]),
                'hargasat' => str_replace(",", "", $validatedData['hargasat'][$index]),
                'hargatot' => str_replace(",", "", $validatedData['hargatot'][$index]),
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ];
        }
        PurchaseOrderItem::insert($itemsData);
        return redirect('/dashboard/purchaseorders')->with('success', 'The new data has been successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show($getId)
    {
        $this->authorize('viewAny', PurchaseOrder::class);
        return view('dashboard.finAcc.purchaseorder.spurchaseorder', [
            "title" => 'Preview',
            "subTitle" => 'fna',
            "purchaseOrder" => PurchaseOrder::with('user', 'principal', 'purchaseOrderItem')->find($getId),
        ]);
    }
    public function getPdf($getId)
    {
        $this->authorize('viewAny', PurchaseOrder::class);
        $purchaseOrder = PurchaseOrder::with('user', 'principal', 'purchaseOrderItem')->where('id_purchaseorder', $getId)->first();
        return view('dashboard.finAcc.purchaseorder.purchaseorderPDF', [
            "title" => "Purchase Order",
            "purchaseOrder" => $purchaseOrder
        ]);

        // view()->share('purchaseOrder', $purchaseOrder);
        // $pdf = PDF::loadview('dashboard.finAcc.purchaseorder.purchaseorderPDF');
        // return $pdf->setPaper('a4', 'potrait')->download($getId . '.pdf');

        // return view('dashboard.finAcc.purchaseorder.pdfpurchaseorder');

        // return $getId;
        // return view('dashboard.finAcc.purchaseorder.pdfpurchaseorder', [
        //     "title" => 'Purchase Order Detail',
        //     "subTitle" => 'fna',
        //     "purchaseOrder" => PurchaseOrder::with('user', 'principal', 'purchaseOrderItem')->where('id_purchaseorder', '=', $getId)->first(),
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit($kodok)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder, $id)
    {
        // dd('masuk pak eko');
        $submit = [
            'status' => 'Waiting for Approval'
        ];
        // dd($id);
        PurchaseOrder::where('id', $id)
            ->update($submit);
        return redirect('/dashboard/purchaseorders')->with('success', "You'r status have been changed");
    }
    public function submit(Request $request, PurchaseOrder $purchaseOrder, $id)
    {
        // dd('masuk pak eko');
        $submit = [
            'status' => 'Waiting for Approval'
        ];
        // dd($id);
        PurchaseOrder::where('id', $id)
            ->update($submit);
        return redirect('/dashboard/purchaseorders')->with('success', "You'r status have been changed");
    }
    public function cancel(Request $request, PurchaseOrder $purchaseOrder, $id)
    {
        // dd('masuk pak eko');
        $submit = [
            'status' => 'Close'
        ];
        // dd($id);
        PurchaseOrder::where('id', $id)
            ->update($submit);
        return redirect('/dashboard/purchaseorders')->with('success', "You'r status have been changed");
    }
    public function approved(Request $request, PurchaseOrder $purchaseOrder, $id)
    {
        // dd('masuk pak eko');
        $submit = [
            'status' => 'Approved'
        ];
        // dd($id);
        PurchaseOrder::where('id', $id)
            ->update($submit);
        return redirect('/dashboard/purchaseorders')->with('success', "You'r status have been changed");
    }
    public function rejected(Request $request, PurchaseOrder $purchaseOrder, $id)
    {
        // dd('masuk pak eko');
        $submit = [
            'status' => 'Rejected'
        ];
        // dd($id);
        PurchaseOrder::where('id', $id)
            ->update($submit);
        return redirect('/dashboard/purchaseorders')->with('success', "You'r status have been changed");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }
}
