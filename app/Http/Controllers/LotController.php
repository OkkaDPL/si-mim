<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use Illuminate\Http\Request;

class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'dashboard.masterdata.lot.mlot',
            [
                "title" => 'Data Lots',
                "subTitle" => 'MasterData',
                "lots" => Lot::all()
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
        return view(
            'dashboard.masterdata.lot.flot',
            [
                "title" => 'Form Lots',
                "subTitle" => 'MasterData',
                "lots" => Lot::all()
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
        $validatedData = $request->validate([
            'kd_lots' => 'required|max:15|unique:lots',
            'exp' => 'required|date',
        ]);

        Lot::create($validatedData);

        return redirect('/dashboard/lots')->with('success', 'The new data has been successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function show(Lot $lot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function edit(Lot $lot)
    {
        return view(
            'dashboard.masterdata.lot.elot',
            [
                "title" => 'Edit Data Lots',
                "subTitle" => 'MasterData',
                "lot" => $lot
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lot $lot)
    {
        $rules = [];
        if ($request->kd_lots != $lot->kd_lots) {
            $rules['kd_lots'] = 'required|max:15|unique:lots';
        }
        if ($request->exp != $lot->exp) {
            $rules['exp'] = 'required|date';
        }

        $validatedData = $request->validate($rules);
        // $validatedData['user_id'] = auth()->user()->id;

        Lot::where('id', $lot->id)
            ->update($validatedData);
        return redirect('/dashboard/lots')->with('success', 'Data has been changed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lot $lot)
    {
        if ($lot->product()->count()) {
            return redirect('dashboard/lots')->with('error', 'Lot exists in another table and cannot be deleted!');
        }

        Lot::destroy($lot->id);

        return redirect('dashboard/lots')->with('success', 'Data has been deleted!');
    }
}
