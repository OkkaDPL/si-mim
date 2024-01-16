<?php

namespace App\Http\Controllers;

use App\Exports\AdjustStockExport;
use App\Models\Bin;
use App\Models\Part;
use App\Models\Inventory;
use App\Models\AdjustStock;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdjustStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.warehousemanagement.adjuststock.madjstock', [
            "title" => "Data Adjust Stock",
            "subTitle" => "wms",
            "adjStock" => AdjustStock::with('inventory', 'user')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'dashboard.warehousemanagement.adjuststock.fadjstock',
            [
                "title" => 'Adjust Stock',
                "subTitle" => 'wms',
                "adjStock" => AdjustStock::with('inventory')->get(),
                "bin" => Bin::with('inventory', 'customer')->whereIn('id', Inventory::pluck('bin_id')->toArray())->get(),
                "part" => Part::with('uom')->get()
            ]
        );
    }

    public function filterPart(Request $request)
    {
        $dapatPart["dataPart"] = Part::whereIn('id', Inventory::where('bin_id', '=', $request->getAllPart)->pluck('part_id')->toArray())->with('uom')->get();
        return response()->json($dapatPart);
    }
    public function filterLot(Request $request)
    {
        $dapatLot["bgst"] = Inventory::with('lot')
            ->where('part_id', $request->getAllLot)
            ->get();
        return response()->json($dapatLot);
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
     * @param  \App\Models\AdjustStock  $adjustStock
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('dashboard.warehousemanagement.adjuststock.sadjstock', [
            "title" => "Detail",
            "subTitle" => "wms",
            "adjStock" => AdjustStock::where('id', $id)->with('inventory', 'user')->first()
        ]);
    }
    public function getExcel()
    {
        return Excel::download(new AdjustStockExport, 'adjusstock.xlsx');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdjustStock  $adjustStock
     * @return \Illuminate\Http\Response
     */
    public function edit(AdjustStock $adjustStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdjustStock  $adjustStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdjustStock $adjustStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdjustStock  $adjustStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdjustStock $adjustStock)
    {
        //
    }
}
