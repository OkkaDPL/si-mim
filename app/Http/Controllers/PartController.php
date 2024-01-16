<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\Satuan;
use App\Models\Category;
use App\Models\Division;
use App\Models\Uom;
use Illuminate\Http\Request;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Part::class);
        return view(
            'dashboard.masterdata.part.mpart',
            [
                "title" => 'Data Parts',
                "subTitle" => 'MasterData',
                "parts" => Part::with(['category', 'uom'])->get() //solusi untuk problem N+1, category didapatkan dari variabel yang dibuat pada model
                // "parts" => Part::all()
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
            'dashboard.masterdata.part.fpart',
            [
                "title" => 'Form Parts',
                "subTitle" => 'MasterData',
                "categories" => Category::all(),
                "uoms" => Uom::all()
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
            'kd_parts' => 'required|max:20|unique:parts',
            'nama' => 'required|max:255',
            'uom_id' => 'required|exists:uoms,id',
            'category_id' => 'required|exists:categories,id',
        ]);
        // dd($validatedData);

        Part::create($validatedData);

        return redirect('/dashboard/parts')->with('success', 'The new data has been successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function show(Part $part)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function edit(Part $part)
    {
        return view(
            'dashboard.masterdata.part.epart',
            [
                "title" => 'Edit Data Divisions',
                "subTitle" => 'MasterData',
                "part" => $part,
                "categories" => Category::all(),
                "uoms" => Uom::all(),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Part $part)
    {
        $rules = [];
        if ($request->kd_parts != $part->kd_parts) {
            $rules['kd_parts'] = 'required|max:20|unique:parts';
        }
        if ($request->nama != $part->nama) {
            $rules['nama'] = 'required|max:255';
        }
        if ($request->uom_id != $part->uom_id) {
            $rules['uom_id'] = 'required|exists:uoms,id';
        }
        if ($request->category_id != $part->category_id) {
            $rules['category_id'] = 'required|exists:categories,id';
        }
        $validatedData = $request->validate($rules);
        // $validatedData['user_id'] = auth()->user()->id;

        Part::where('id', $part->id)
            ->update($validatedData);
        return redirect('/dashboard/parts')->with('success', 'Data has been changed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function destroy(Part $part)
    {
        if ($part->product()->count()) {
            return redirect('dashboard/parts')->with('error', 'Part exists in another table and cannot be deleted!');
        }

        Part::destroy($part->id);

        return redirect('dashboard/parts')->with('success', 'Data has been deleted!');
    }
}
