<?php

namespace App\Http\Controllers;

use App\Models\Principal;
use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Principal::class);
        return view(
            'dashboard.masterdata.principal.mprincipal',
            [
                "title" => 'Data Principals',
                "subTitle" => 'MasterData',
                "principals" => Principal::all()
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
        $this->authorize('viewAny', Principal::class);
        return view(
            'dashboard.masterdata.principal.fprincipal',
            [
                "title" => 'Form Principals',
                "subTitle" => 'MasterData',
                "principals" => Principal::all()
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
            'nama' => 'required|max:50',
            'tlp' => 'required|min:7|max:13',
            'email' => 'required|email:dns|unique:principals',
            'alamat' => 'required|max:255',
            'drek' => 'required|max:20',
            'norek' => 'required|min:10|max:15',
        ]);
        // dd($validatedData);

        Principal::create($validatedData);

        return redirect('/dashboard/principals')->with('success', 'The new data has been successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Principal  $principal
     * @return \Illuminate\Http\Response
     */
    public function show(Principal $principal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Principal  $principal
     * @return \Illuminate\Http\Response
     */
    public function edit(Principal $principal)
    {
        $this->authorize('viewAny', Principal::class);
        return view(
            'dashboard.masterdata.principal.eprincipal',
            [
                "title" => 'Edit Data Principal',
                "subTitle" => 'MasterData',
                "principal" => $principal
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Principal  $principal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Principal $principal)
    {
        $rules = [];
        if ($request->nama != $principal->nama) {
            $rules['nama'] = 'required|max:50';
        }
        if ($request->tlp != $principal->tlp) {
            $rules['tlp'] = 'required|min:7|max:13';
        }
        if ($request->email != $principal->email) {
            $rules['email'] = 'required|email:dns|unique:principals';
        }
        if ($request->alamat != $principal->alamat) {
            $rules['alamat'] = 'required|max:255';
        }
        if ($request->drek != $principal->drek) {
            $rules['drek'] = 'required|max:20';
        }
        if ($request->norek != $principal->norek) {
            $rules['norek'] = 'required|max:20';
        }

        $validatedData = $request->validate($rules);
        Principal::where('id', $principal->id)
            ->update($validatedData);
        return redirect('/dashboard/principals')->with('success', 'Data has been changed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Principal  $principal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Principal $principal)
    {
        if ($principal->purchaseorder()->count()) {
            return redirect('dashboard/principals')->with('error', 'Principal exists in another table and cannot be delete!');
        }
        Principal::destroy($principal->id);

        return redirect('dashboard/principals')->with('success', 'Data has been deleted!');
    }
}
