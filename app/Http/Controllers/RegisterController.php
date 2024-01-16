<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Unique;

class RegisterController extends Controller
{
    //method create
    public function create()
    {
        return view('login-dan-register.register', [
            'title' => "Register"
        ]);
    }

    //method show untuk mengambil data inputan
    public function store(Request $request) //request digunakan untuk mengambil/nangkap semua data yang dimasukan pada form input di view.
    {
        //validate untuk memvalidasi data sebelum masuk ke database/sebelum lanjut ke halaman selanjutnya

        $validatedData = $request->validate([
            // 'name' => ['required', 'min:3', 'max:50'],
            'username' => ['required', 'min:3', 'max:10', 'unique:users'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:5', 'max:20']
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        // $request->session()->flash('success', 'Registration successful! Please login');

        return redirect('/login')->with('success', 'Registration successful! Please login');
    }
}
