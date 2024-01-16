<?php

namespace App\Exports;

use App\Models\DeliveryOrder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DeliveryOrderExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('dashboard.warehousemanagement.deliveryorder.deliveryorderxls', [
            "deliveryOrder" => DeliveryOrder::with('salesOrder', 'warehouse', 'customer', 'bin')->get()
        ]);
    }
}
