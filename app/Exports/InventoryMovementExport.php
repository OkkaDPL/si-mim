<?php

namespace App\Exports;

use App\Models\InventoryMovement;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InventoryMovementExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('dashboard.warehousemanagement.inventorymovement.inventorymovementxls', [
            "inventorymovement" => InventoryMovement::with('inventory')->get(),
        ]);
    }
}
