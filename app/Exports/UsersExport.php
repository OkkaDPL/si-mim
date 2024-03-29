<?php

namespace App\Exports;

use app\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('dashboard.masterdata.user.userxls', [
            'users' => User::all()
        ]);
    }
}
