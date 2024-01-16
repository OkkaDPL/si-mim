<?php

namespace App\Exports;

use App\Models\PurchaseOrder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PurchaseOrderExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('dashboard.finAcc.purchaseorder.purchaseorderxls', [
            "purchaseorder" => PurchaseOrder::with('user', 'principal', 'purchaseOrderDetail', 'purchaseOrderItem')->get(),
        ]);
    }
}
