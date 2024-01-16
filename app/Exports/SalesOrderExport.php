<?php

namespace App\Exports;

use App\Models\SalesOrder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SalesOrderExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('dashboard.transaksi.salesorder.salesorderxls', [
            "salesOrders" => SalesOrder::with('employee', 'customer', 'bin')->get(),
        ]);
    }
}
