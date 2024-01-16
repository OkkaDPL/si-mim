<?php

namespace App\Exports;

use App\Models\GoodReceipt;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class GoodReceiptExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('dashboard.warehousemanagement.goodreceipt.goodreceiptxls', [
            "goodreceipts" => GoodReceipt::orderBy('id_goodreceipt', 'asc')->with('purchaseOrder')->get(),
        ]);
    }
}
