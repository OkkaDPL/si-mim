<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InvoiceExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('dashboard.billing.invoice.invoicexls', [
            "invoice" => Invoice::with('deliveryOrder')->get()
        ]);
    }
}
