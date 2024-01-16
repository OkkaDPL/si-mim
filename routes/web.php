<?php

use App\Http\Controllers\AdjustStockController;
use App\Http\Controllers\BinController;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerProspectController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliveryOrderController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GoodReceiptController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InventoryMovementController;
use App\Http\Controllers\InventoryTransferController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LotController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view(
        'welcome',
        [
            "title" => 'Medev Indo Makmur',
            "words" => ['health', 'days', 'lives'],
            "aboutus" => "Medev Indo Makmur was founded in 2020 with the aim of providing leading and innovative health solutions for the community. As a growing distributor of medical devices, we are committed to providing high quality products, excellent customer service and making a significant contribution to the healthcare sector."
        ]
    );
});
Route::get('/productsOT', function () {
    return view(
        'productOT',
        [
            "title" => 'Products Orthopaedic',
            "division" => 'Orthopaedic',
        ]

    );
});
Route::get('/productsCV', function () {
    return view(
        'productCV',
        [
            "title" => 'Products Cardiovascular',
            "division" => 'Cardiovascular',
        ]

    );
});
Route::get('/productsDC', function () {
    return view(
        'productDC',
        [
            "title" => 'Products Dental Care',
            "division" => 'Dental Care',
        ]

    );
});

Route::resource('/dashboard/users', UserController::class)->middleware(['auth']);
Route::get('/exportExcel/users', [UserController::class, 'getExcel'])->middleware('auth');

Route::resource('/dashboard/divisions', DivisionController::class)->middleware('auth');
Route::resource('/dashboard/uoms', UomController::class)->middleware('auth');
Route::resource('/dashboard/employees', EmployeeController::class)->middleware(['auth']);
Route::resource('/dashboard/principals', PrincipalController::class)->middleware('auth');
Route::resource('/dashboard/customers', CustomerController::class)->middleware('auth');
Route::resource('/dashboard/categories', CategoryController::class)->middleware('auth');
Route::resource('/dashboard/parts', PartController::class)->middleware('auth');
Route::resource('/dashboard/lots', LotController::class)->middleware('auth');
Route::resource('/dashboard/warehouses', WarehouseController::class)->middleware('auth');
Route::resource('/dashboard/bins', BinController::class)->middleware('auth');
Route::resource('/dashboard/products', ProductController::class)->middleware('auth');

Route::resource('/dashboard/adjuststock', AdjustStockController::class)->except(['create', 'edit'])->middleware('auth');
Route::get('/exportExcel/adjuststock', [AdjustStockController::class, 'getExcel'])->middleware('auth');

Route::resource('/dashboard/customerprospects', CustomerProspectController::class);
Route::get('/exportExcel/customerprospects', [CustomerProspectController::class, 'getExcel'])->middleware('auth');
Route::put('/dashboard/customerprospects/{a}/respond', [CustomerProspectController::class, 'respond'])->middleware('auth');

Route::resource('/dashboard/purchaseorders', PurchaseOrderController::class)->middleware('auth');
Route::put('/dashboard/purchaseorders/{apajadah}/submit', [PurchaseOrderController::class, 'submit'])->middleware('auth');
Route::put('/dashboard/purchaseorders/{apajadah}/cancel', [PurchaseOrderController::class, 'cancel'])->middleware('auth');
Route::put('/dashboard/purchaseorders/{apajadah}/approved', [PurchaseOrderController::class, 'approved'])->middleware('auth');
Route::put('/dashboard/purchaseorders/{apajadah}/rejected', [PurchaseOrderController::class, 'rejected'])->middleware('auth');
Route::get('/dashboard/purchaseorders/{apaaja}/exportPDF', [PurchaseOrderController::class, 'getPdf'])->middleware('auth');
Route::get('/exportExcel/purchaseorders', [PurchaseOrderController::class, 'getExcel'])->middleware('auth');

Route::resource('/dashboard/goodreceipts', GoodReceiptController::class)->middleware('auth');
Route::post('/dashboard/goodreceipts/getitem', [GoodReceiptController::class, 'getDtlItemPO'])->middleware('auth');
Route::get('/exportExcel/goodreceipts', [GoodReceiptController::class, 'getExcel'])->middleware('auth');
Route::get('/dashboard/goodreceipts/{apaJaDah}/exportPDF', [GoodReceiptController::class, 'getPdf'])->middleware('auth');

Route::resource('/dashboard/inventorytransfer', InventoryTransferController::class)->middleware('auth');
Route::post('/dashboard/inventorytransfer/triggedBin', [InventoryTransferController::class, 'triggedBin'])->middleware('auth');
Route::get('/exportExcel/inventorytransfer', [InventoryTransferController::class, 'getExcel'])->middleware('auth');
Route::get('/dashboard/inventorytransfer/{apaJaDah}/exportPDF', [InventoryTransferController::class, 'getPdf'])->middleware('auth');

Route::resource('/dashboard/inventories', InventoryController::class)->middleware('auth');
Route::get('/dashboard/inventories/{apaaja}/adjustStock', [InventoryController::class, 'adjStock'])->middleware('auth');
Route::put('/dashboard/inventories/adjustStock/{apaaja}', [InventoryController::class, 'updateAdjStock'])->middleware('auth');
Route::get('/exportExcel/inventories', [InventoryController::class, 'getExcel'])->middleware('auth');

Route::resource('/dashboard/salesorders', SalesOrderController::class)->middleware('auth');
Route::post('/dashboard/salesorders/triggedStockOn', [SalesOrderController::class, 'triggedStockOn'])->middleware('auth');
Route::post('/dashboard/salesorders/getCustomer', [SalesOrderController::class, 'getCustomer'])->middleware('auth');
Route::get('/exportExcel/salesorders', [SalesOrderController::class, 'getExcel'])->middleware('auth');
Route::get('/dashboard/salesorders/{apaJaDah}/exportPDF', [SalesOrderController::class, 'getPdf'])->middleware('auth');

Route::resource('/dashboard/deliveryorders', DeliveryOrderController::class)->middleware('auth');
Route::post('/dashboard/deliveryorders/getItemSo', [DeliveryOrderController::class, 'getItemSO'])->middleware('auth');
Route::get('/exportExcel/deliveryorders', [DeliveryOrderController::class, 'getExcel'])->middleware('auth');
Route::get('/dashboard/deliveryorders/{apaJaDah}/exportPDF', [DeliveryOrderController::class, 'getPdf'])->middleware('auth');

Route::resource('/dashboard/invoice', InvoiceController::class)->middleware('auth');
Route::post('/dashboard/invoice/getItemInvoice', [InvoiceController::class, 'itemInvoice'])->middleware('auth');
Route::get('/exportExcel/invoice', [InvoiceController::class, 'getExcel'])->middleware('auth');
Route::get('/dashboard/invoice/{apaJaDah}/exportPDF', [InvoiceController::class, 'getPdf'])->middleware('auth');
Route::get('/dashboard/invoice/kwitansi/{apaJaDah}/exportPDF', [InvoiceController::class, 'getKwtPdf'])->middleware('auth');

Route::resource('/dashboard/inventorymovement', InventoryMovementController::class)->middleware('auth');
Route::get('/exportExcel/inventoryMovement', [InventoryMovementController::class, 'getExcel'])->middleware('auth');

// Route::post('/dashboard/test/triggedBin', [TestController::class, 'triggedBin'])->middleware('auth');
// Route::post('/dashboard/test/triggedInven', [TestController::class, 'triggedInven'])->middleware('auth');
// Route::resource('/dashboard/test', TestController::class)->middleware('auth');
// function () {
//     return view('dashboard.masterdata.product.mproduct',
// [
//     "title" => 'Form User',
//     "products" => Product::all()
// ]);
// })->middleware('auth');


Route::get('/login', [LoginController::class, 'create'])->name('login')->middleware('guest'); //view dan harus dikasih nama login karena authentikasi belajar laravel eps 16 min 32
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'create'])->middleware('auth');
