<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Division::class);
        return view(
            'dashboard.masterdata.division.mdivision',
            [
                "title" => 'Data Divisions',
                "subTitle" => 'MasterData',
                "divisions" => Division::all()
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
        $this->authorize('viewAny', Division::class);
        return view('dashboard.masterdata.division.fdivision', [
            "title" => 'Form Divisions',
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
            'nama' => ['required', 'min:3', 'max:50', 'unique:divisions,nama'],
            'nick' => ['required', 'min:2', 'max:5', 'unique:divisions,nick'],
        ]);
        Division::create($validatedData);
        // $validatedData = $request->validate([
        //     'nama.*' => ['required', 'min:3', 'max:50', 'unique:divisions,nama'],
        //     'nick.*' => ['required', 'min:2', 'max:5', 'unique:divisions,nick'],
        // ], [
        //     'nama.*.required' => 'Nama divisi harus diisi!',
        //     'nama.*.min' => 'Nama divisi minimal 3 karakter',
        //     'nama.*.max' => 'Nama divisi maksimal 50 karakter',
        //     'nama.*.unique' => 'Nama divisi sudah digunakan',
        //     'nick.*.required' => 'Nick divisi harus diisi',
        //     'nick.*.min' => 'Nick divisi minimal 2 karakter',
        //     'nick.*.max' => 'Nick divisi maksimal 5 karakter',
        //     'nick.*.unique' => 'Nick divisi sudah digunakan',
        // ]);

        // // $divisions = [];
        // $waktu = Carbon::now();
        // foreach ($validatedData['nama'] as $key => $value) {
        //     $divisions[] = [
        //         'nama' => $validatedData['nama'][$key],
        //         'nick' => $validatedData['nick'][$key],
        //         'created_at' => $waktu,
        //         'updated_at' => $waktu,
        //     ];
        // }

        // // dd($divisions);
        // Division::insert($divisions);

        return redirect('/dashboard/divisions')->with('success', 'The new data has been successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function show(Division $division)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function edit(Division $division)
    {
        $this->authorize('viewAny', Division::class);
        return view(
            'dashboard.masterdata.division.edivision',
            [
                "title" => 'Edit Data Divisions',
                "subTitle" => 'MasterData',
                "division" => $division
            ]
        );
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Division $division)
    {
        $rules = [];
        if ($request->nama != $division->nama) {
            $rules['nama'] = 'required|min:3|max:50|unique:divisions';
        }
        if ($request->nick != $division->nick) {
            $rules['nick'] = 'required|min:2|max:5|unique:divisions';
        }

        $validatedData = $request->validate($rules);
        // // $validatedData['user_id'] = auth()->user()->id;

        Division::where('id', $division->id)
            ->update($validatedData);
        return redirect('/dashboard/divisions')->with('success', 'Data has been changed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */

    public function destroy(Division $division)
    {
        if ($division->category()->count()) {
            return redirect('dashboard/divisions')->with('error', 'Division exists in another table and cannot be deleted!');
        }
        Division::destroy($division->id);
        return redirect('dashboard/divisions')->with('success', 'Data has been deleted!');
    }
}
