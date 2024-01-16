<?php

namespace App\Exports;

use App\Models\AdjustStock;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AdjustStockExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('dashboard.warehousemanagement.adjuststock.adjstockxls', [
            "adjStock" => AdjustStock::with('inventory', 'user')->get(),
        ]);
    }
}
