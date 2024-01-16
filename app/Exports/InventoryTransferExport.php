<?php

namespace App\Exports;

use App\Models\InventoryTransfer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InventoryTransferExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('dashboard.warehousemanagement.inventorytransfer.inventorytransferxls', [
            "inventorytransfer" => InventoryTransfer::with('user', 'fromBin', 'toBin')->get()
        ]);
    }
}
