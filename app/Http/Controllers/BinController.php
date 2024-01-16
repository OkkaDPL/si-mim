<?php

namespace App\Http\Controllers;

use App\Models\Bin;
use App\Models\Customer;
use Illuminate\Http\Request;

class BinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Bin::class);
        return view(
            'dashboard.masterdata.bin.mbin',
            [
                "title" => 'Master Bin',
                "subTitle" => 'MasterData',
                "bins" => Bin::with(['customer'])->get() //solusi untuk problem N+1, semua variabel didapatkan dari variabel yang dibuat pada model
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
        $this->authorize('viewAny', Bin::class);
        return view('dashboard.masterdata.bin.fbin', [
            "title" => 'Form Bins',
            "subTitle" => 'MasterData',
            // "users" => User::all()
            "customers" => Customer::whereNotIn('id', Bin::pluck('customer_id')->toArray())->get()
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
            'customer_id' => 'required|exists:customers,id',
            'alamat' => 'required|max:255'
        ]);

        Bin::create($validatedData);

        return redirect('/dashboard/bins')->with('success', 'Data berhasil ditambahkan!.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bin  $bin
     * @return \Illuminate\Http\Response
     */
    public function show(Bin $bin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bin  $bin
     * @return \Illuminate\Http\Response
     */
    public function edit(Bin $bin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bin  $bin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bin $bin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bin  $bin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bin $bin)
    {
        Bin::destroy($bin->id);
        return redirect('dashboard/bins')->with('success', 'Data berhasil dihapus!');
    }
}
