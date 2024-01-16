<?php

namespace App\Http\Controllers;

use App\Exports\CustomerProspectExport;
use App\Models\CustomerProspect;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CustomerProspectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', CustomerProspect::class);
        return view('dashboard.transaksi.prospects.mcprospect', [
            'title' => 'Data Customer Prospects',
            'subTitle' => 'Transaksi',
            "customerProspect" => CustomerProspect::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'fname' => ['required', 'min:1', 'max:10'],
            'lname' => ['required', 'min:1', 'max:10'],
            'email' => ['required', 'email:dns', 'unique:customer_prospects'],
            'tlp' => ['required', 'min:7', 'max:13'],
            'message' => ['required', 'max:255'],
        ]);
        $validatedData['status'] = 'Waiting for response';
        CustomerProspect::create($validatedData);
        return redirect('/#booking')->with('success', "You'r data has been recorded!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerProspect  $customerProspect
     * @return \Illuminate\Http\Response
     */
    public function show($kcg)
    {
        $this->authorize('viewAny', CustomerProspect::class);
        return view('dashboard.transaksi.prospects.scprospect', [
            'title' => 'Detail Customer Prospects',
            'subTitle' => 'cp',
            "i" => CustomerProspect::find($kcg)
        ]);
    }
    public function respond($kcg)
    {
        $this->authorize('viewAny', CustomerProspect::class);
        $submit = [
            'status' => 'Responded'
        ];
        // dd($id);
        CustomerProspect::where('id', $kcg)
            ->update($submit);
        return redirect('/dashboard/customerprospects')->with('success', "You'r status have been changed");
    }

    public function getExcel()
    {
        return Excel::download(new CustomerProspectExport, 'customerprospect.xls');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerProspect  $customerProspect
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerProspect $customerProspect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerProspect  $customerProspect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerProspect $customerProspect)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerProspect  $customerProspect
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerProspect $customerProspect)
    {
        //
    }
}
