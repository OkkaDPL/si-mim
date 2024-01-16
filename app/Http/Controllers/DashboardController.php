<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\PurchaseOrder;
use App\Models\SalesOrder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function create()
    {
        return view('dashboard.dashboard', [
            'title' => 'Dashboard',
            'subTitle' => 'Dashboard',
            "salesOrder" => SalesOrder::where('status', '=', 'Invoiced')->sum('gtotal'),
            "purchaseOrder" => PurchaseOrder::where('status', '=', 'Received',)->sum('gtotal')
        ]);
    }
}
