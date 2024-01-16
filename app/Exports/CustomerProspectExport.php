<?php

namespace App\Exports;

use App\Models\CustomerProspect;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CustomerProspectExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('dashboard.transaksi.prospects.cprospectxls', [
            "cp" => CustomerProspect::all()
        ]);
    }
}
