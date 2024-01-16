<?php

namespace App\Exports;

use App\Models\Inventory;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InventoryExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('dashboard.warehousemanagement.inventory.inventoryxls', [
            "inventories" => Inventory::orderBy('id', 'asc')->with('bin', 'warehouse', 'lot', 'part')->where('qty', '>', 0)->get()
        ]);
    }
}
