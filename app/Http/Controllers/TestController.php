<?php

namespace App\Http\Controllers;

use App\Models\Bin;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function triggedBin(Request $request)
    {
        $dataInvenTriggedBin["inventoryTriggedBin"] = Inventory::with('part', 'lot')
            ->where('bin_id', '=', $request->get_bin)
            ->orderBy('part_id', 'asc')
            ->get();

        return response()->json($dataInvenTriggedBin);
    }

    public function triggedPart(Request $request)
    {
        $dataInven["inventory"] = Inventory::with('part', 'bin')->where('bin_id', $request->get_bin)->get();
        return response()->json($dataInven);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'dashboard.test.test',
            [
                "bin" => Bin::all(),
                "subTitle" => 'Test',
                "title" => 'Test',
                // "inventory" => Inventory::where('bin_id', 'id')->get() //solusi untuk problem N+1, category didapatkan dari variabel yang dibuat pada model
            ]
        );
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
