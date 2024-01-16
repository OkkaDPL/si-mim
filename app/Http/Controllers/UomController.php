<?php

namespace App\Http\Controllers;

use App\Models\Uom;
use Illuminate\Http\Request;

class UomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Uom::class);
        return view(
            'dashboard.masterdata.uom.muom',
            [
                "title" => 'Data UOM',
                "subTitle" => 'MasterData',
                "uoms" => Uom::all() //solusi untuk problem N+1, semua variabel didapatkan dari variabel yang dibuat pada model
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
        $this->authorize('viewAny', Uom::class);
        return view('dashboard.masterdata.uom.fuom', [
            "title" => 'Form UOM',
            "subTitle" => 'MasterData',
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
        $validatedData = $request->validate([
            'nama' => 'required|max:10|unique:uoms',
        ], [
            'nama.required' => 'Kolom tidak boleh kosong!',
            'nama.max' => 'UOM maksimal 10 karakter.',
            'nama.unique' => 'UOM sudah digunakan.',
        ]);

        Uom::create($validatedData);

        return redirect('/dashboard/uoms')->with('success', 'The new data has been successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Uom  $uom
     * @return \Illuminate\Http\Response
     */
    public function show(Uom $uom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Uom  $uom
     * @return \Illuminate\Http\Response
     */
    public function edit(Uom $uom)
    {
        $this->authorize('viewAny', Uom::class);
        return view('dashboard.masterdata.uom.euom', [
            "title" => 'Edit UOM',
            "subTitle" => 'MasterData',
            "uom" => $uom,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Uom  $uom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Uom $uom)
    {
        $rules = [];
        if ($request->nama != $uom->nama) {
            $rules['nama'] = 'required|max:10|unique:uoms';
        }
        $validatedData = $request->validate($rules);
        Uom::where('id', $uom->id)
            ->update($validatedData);
        return redirect('/dashboard/uoms')->with('success', 'Data has been changed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Uom  $uom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Uom $uom)
    {
        if ($uom->part()->count()) {
            return redirect('dashboard/uoms')->with('error', 'UOM exists in another table and cannot be deleted!');
        }

        Uom::destroy($uom->id);

        return redirect('dashboard/uoms')->with('success', 'Data has been deleted!');
    }
}
