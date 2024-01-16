<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\User;
use App\Models\Division;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Employee::class);
        return view('dashboard.masterdata.employee.memployee', [
            "title" => 'Data Employees',
            "subTitle" => 'MasterData',
            "employees" => Employee::with('division')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('viewAny', Employee::class);
        return view('dashboard.masterdata.employee.femployee', [
            "title" => 'Form Employees',
            "subTitle" => 'MasterData',
            "employees" => Employee::all(),
            "division" => Division::all(),
            "users" => User::whereNotIn('id', Employee::pluck('user_id')->toArray())->get()
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
            'nama' => 'required|max:50',
            'bod' => 'required|date',
            'tlp' => 'required|min:7|max:13',
            'user_id' => 'required|exists:users,id',
            'tgl_msk' => 'required|date',
            'division' => '',
            'status' => 'required'
        ]);
        // dd($validatedData);
        Employee::create($validatedData);

        return redirect('/dashboard/employees')->with('success', 'The new data has been successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $this->authorize('viewAny', Employee::class);
        return view(
            'dashboard.masterdata.employee.eemployee',
            [
                "title" => 'Edit Data Employees',
                "subTitle" => 'MasterData',
                "employee" => $employee,
                "division" => Division::all(),
                "users" => User::all()
                // "users" => User::whereNotIn('id', Employee::pluck('user_id')->toArray())->get()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        // dd($request->all());
        $rules = [];
        if ($request->nama != $employee->nama) {
            $rules['nama'] = 'required|max:50';
        }
        if ($request->bod != $employee->bod) {
            $rules['bod'] = 'required|date';
        }
        if ($request->tlp != $employee->tlp) {
            $rules['tlp'] = 'required|min:7|max:13';
        }
        if ($request->user_id != $employee->user_id) {
            $rules['user_id'] = 'required|exists:users,id|unique:employees';
        }
        if ($request->tgl_msk != $employee->tgl_msk) {
            $rules['tgl_msk'] = 'required|date';
        }
        // if ($request->level != $employee->level) {
        //     $rules['level'] = 'required';
        // }
        if ($request->departement_id != $employee->departement_id) {
            $rules['departement_id'] = 'required|exists:departements,id';
        }
        if ($request->status != $employee->status) {
            $rules['status'] = 'required';
        }
        $validatedData = $request->validate($rules);
        // $validatedData['user_id'] = auth()->user()->id;

        Employee::where('id', $employee->id)
            ->update($validatedData);
        return redirect('/dashboard/employees')->with('success', 'Data has been changed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if ($employee->division() || $employee->salesOrder()) {
            return redirect('dashboard/employees')->with('error', 'Employee exists in another table and cannot be deleted!');
        }
        Employee::destroy($employee->id);
        return redirect('dashboard/employees')->with('success', 'Data has been deleted!');
    }
}
