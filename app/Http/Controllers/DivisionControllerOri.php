<?php

namespace App\Http\Controllers;

use App\Models\Division;
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
        return view('dashboard.masterdata.division.mdivision',
        [
            "title" => 'Data Divisions',
            "subTitle" => 'MasterData',
            "divisions" => Division::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.masterdata.division.fdivision',[
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
        $validatedData= $request->validate([
            'nama' => ['required', 'min:3', 'max:50', 'unique:divisions'],
            'nick' => ['required', 'min:2', 'max:5', 'unique:divisions'],
        ]);

        dd($validatedData);
        Division::create($validatedData);

        // $request->session()->flash('success', 'Registration successful! Please login');

        return redirect('/dashboard/divisions')->with('success', 'Data Berhasil Ditambahkan!');
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
        return view('dashboard.masterdata.division.edivision',
        [
            "title" => 'Edit Data Divisions',
            "subTitle" => 'MasterData',
            "division" => $division
        ]);
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
        $rules=[];
        if($request->nama != $division->nama)
        {
            $rules['nama'] = 'required|min:3|max:50|unique:divisions';
        }
        if($request->nick != $division->nick)
        {
            $rules['nick'] = 'required|min:2|max:5|unique:divisions';
        }

        $validatedData = $request->validate($rules);
        // $validatedData['user_id'] = auth()->user()->id;

        Division::where('id', $division->id)
        ->update($validatedData);
        return redirect('/dashboard/divisions')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */

    public function destroy(Division $division)
    {
        if ($division->category()->count() || $division->product()->count() || $division->employee()->count()){
            return redirect('dashboard/divisions')->with('error', 'Division exists in another table and cannot be deleted!');
        }

        Division::destroy($division->id);
        return redirect('dashboard/divisions')->with('success', 'Data berhasil dihapus!');
    }
}
