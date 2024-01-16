<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        return view(
            'dashboard.masterdata.user.muser',
            [
                "title" => 'Data Users',
                "subTitle" => 'MasterData',
                "users" => User::all()
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
        $this->authorize('viewAny', User::class);
        return view(
            'dashboard.masterdata.user.fuser',
            [
                "title" => 'Form Users',
                "subTitle" => 'MasterData',
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
            // 'name' => ['required', 'min:3', 'max:50'],
            'username' => ['required', 'min:3', 'max:10', 'unique:users'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:5', 'max:20'],
            'departement' => ['required']
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        // $request->session()->flash('success', 'Registration successful! Please login');

        return redirect('/dashboard/users')->with('success', 'The new data has been successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('viewAny', User::class);
        return view(
            'dashboard.masterdata.user.euser',
            [
                "title" => 'Edit Data User',
                "subTitle" => 'MasterData',
                "user" => $user
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) //$request utk membaca apa yang kita ketik di form
    {
        // $rules=
        // [
        //     'name' => ['required', 'min:3', 'max:50'],
        //     'password' => ['required', 'min:5', 'max:20']
        // ];

        $rules = [];
        if ($request->username != $user->username) {
            $rules['username'] = 'required|min:3|max:10|unique:users';
        }

        if ($request->email != $user->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }
        if ($request->password != $user->password) {
            $rules['password'] = 'required|min:5|max:20';
        }
        if ($request->departement != $user->level) {
            $rules['departement'] = 'required';
        }

        $validatedData = $request->validate($rules);
        if (isset($validatedData['password'])) { //menggunakan ifisset karena password memiliki nilai hasing sehingga tidak terbaca
            $validatedData['password'] = Hash::make($validatedData['password']);
        }
        User::where('id', $user->id)
            ->update($validatedData);
        return redirect('/dashboard/users')->with('success', 'Data has been changed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */

    public function destroy(User $user)
    {
        if ($user->employee()->count() || $user->goodReceipt()->count() || $user->inventoryTransfer()->count() || $user->invoice()->count() || $user->purchaseOrder()->count() || $user->salesOrder()->count()) {
            return redirect('dashboard/users')->with('error', 'User exists in another table and cannot be deleted!');
        }

        User::destroy($user->id);

        return redirect('dashboard/users')->with('success', 'Data has been deleted!');
    }
    public function getExcel()
    {
        return Excel::download(new UsersExport, 'user.xlsx');
    }
}
