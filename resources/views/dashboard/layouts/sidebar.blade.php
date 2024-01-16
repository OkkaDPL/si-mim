<div class="sidebar-content">
    <ul class="nav">
        <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard">
                <i class="fas fa-home"></i>
                <p>Dashboard</p>
                {{-- <span class="badge badge-count">5</span> --}}
            </a>
        </li>
        <li class="nav-section">
            <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">fiturs</h4>
        </li>
        @if (auth()->user()->departement != 'Management')
            @if ($subTitle == 'MasterData')
                <li class="nav-item active submenu">
                @else
                <li class="nav-item">
            @endif
            <a data-toggle="collapse" href="#master">
                <i class="fas fa-folder"></i>
                <p>Master Data</p>
                <span class="caret"></span>
            </a>
            @if ($subTitle == 'MasterData')
                <div class="collapse show" id="master">
                @else
                    <div class="collapse" id="master">
            @endif
            <ul class="nav nav-collapse">
                @if (auth()->user()->departement == 'IT')
                    <li class="nav-item {{ Request::is('dashboard/users*') ? 'active' : '' }}">
                        <a href="/dashboard/users">
                            <span class="sub-item">User</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->departement == 'HRD' || auth()->user()->departement == 'IT')
                    <li class="nav-item {{ Request::is('dashboard/employees*') ? 'active' : '' }}">
                        <a href="/dashboard/employees">
                            <span class="sub-item">Employee</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->departement == 'Finance and Accounting' || auth()->user()->departement == 'IT')
                    <li class="nav-item {{ Request::is('dashboard/principals*') ? 'active' : '' }}">
                        <a href="/dashboard/principals">
                            <span class="sub-item">Principal</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->departement == 'Billing' || auth()->user()->departement == 'IT')
                    <li class="nav-item {{ Request::is('dashboard/customers*') ? 'active' : '' }}">
                        <a href="/dashboard/customers">
                            <span class="sub-item">Customer</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->departement == 'IT')
                    <li class="nav-item {{ Request::is('dashboard/divisions*') ? 'active' : '' }}">
                        <a href="/dashboard/divisions">
                            <span class="sub-item">Division</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->departement == 'Product' || auth()->user()->departement == 'IT')
                    <li class="nav-item {{ Request::is('dashboard/categories*') ? 'active' : '' }}">
                        <a href="/dashboard/categories">
                            <span class="sub-item">Category</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->departement == 'Warehouse' || auth()->user()->departement == 'IT')
                    <li class="nav-item {{ Request::is('dashboard/uoms*') ? 'active' : '' }}">
                        <a href="/dashboard/uoms">
                            <span class="sub-item">UOM</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->departement == 'Product' || auth()->user()->departement == 'IT')
                    <li class="nav-item {{ Request::is('dashboard/parts*') ? 'active' : '' }}">
                        <a href="/dashboard/parts">
                            <span class="sub-item">Part</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->departement == 'Warehouse' || auth()->user()->departement == 'IT')
                    <li class="nav-item {{ Request::is('dashboard/lot*') ? 'active' : '' }}">
                        <a href="/dashboard/lots">
                            <span class="sub-item">LOT</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->departement == 'IT')
                    <li class="nav-item {{ Request::is('dashboard/warehouses*') ? 'active' : '' }}">
                        <a href="/dashboard/warehouses">
                            <span class="sub-item">Warehouse</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('dashboard/bins*') ? 'active' : '' }}">
                        <a href="/dashboard/bins">
                            <span class="sub-item">Bin</span>
                        </a>
                    </li>
                @endif
            </ul>
</div>
@endif
@if (auth()->user()->departement == 'IT' ||
        auth()->user()->departement == 'Product' ||
        auth()->user()->departement == 'Management')
    @if ($subTitle == 'Transaksi')
        <li class="nav-item active submenu">
        @else
        <li class="nav-item">
    @endif
    <a data-toggle="collapse" href="#forms">
        <i class="fas fa-pen-square"></i>
        <p>Product</p>
        <span class="caret"></span>
    </a>
    @if ($subTitle == 'Transaksi')
        <div class="collapse show" id="forms">
        @else
            <div class="collapse" id="forms">
    @endif
    <ul class="nav nav-collapse">
        <li class="nav-item {{ Request::is('dashboard/salesorders*') ? 'active' : '' }}">
            <a href="/dashboard/salesorders">
                <span class="sub-item">Sales Order</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('dashboard/customerprospects*') ? 'active' : '' }}">
            <a href="/dashboard/customerprospects">
                <span class="sub-item">Customer Prospects</span>
            </a>
        </li>
    </ul>
@endif
@if ($subTitle == 'wms')
    <li class="nav-item active submenu">
    @else
    <li class="nav-item">
@endif
<a data-toggle="collapse" href="#warehousemanagement">
    <i class="fas fa-boxes"></i>
    <p>Warehouse Management</p>
    <span class="caret"></span>
</a>
@if ($subTitle == 'wms')
    <div class="collapse show" id="warehousemanagement">
    @else
        <div class="collapse" id="warehousemanagement">
@endif
<ul class="nav nav-collapse">
    <li class="nav-item {{ Request::is('dashboard/inventories*') ? 'active' : '' }}">
        <a href="/dashboard/inventories">
            <span class="sub-item">Inventory</span>
        </a>
    </li>
    <li class="nav-item {{ Request::is('dashboard/inventorymovement*') ? 'active' : '' }}">
        <a href="/dashboard/inventorymovement">
            <span class="sub-item">Inventory Movement</span>
        </a>
    </li>
    @if (auth()->user()->departement == 'IT' ||
            auth()->user()->departement == 'Warehouse' ||
            auth()->user()->departement == 'Management')
        <li class="nav-item {{ Request::is('dashboard/goodreceipts*') ? 'active' : '' }}">
            <a href="/dashboard/goodreceipts">
                <span class="sub-item">Good Receipt</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('dashboard/inventorytransfer*') ? 'active' : '' }}">
            <a href="/dashboard/inventorytransfer">
                <span class="sub-item">MIT</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('dashboard/deliveryorders*') ? 'active' : '' }}">
            <a href="/dashboard/deliveryorders">
                <span class="sub-item">Delivery Order</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('dashboard/adjuststock*') ? 'active' : '' }}">
            <a href="/dashboard/adjuststock">
                <span class="sub-item">Adjust Stock</span>
            </a>
        </li>
    @endif
</ul>
@if (auth()->user()->departement == 'Finance and Accounting' ||
        auth()->user()->departement == 'IT' ||
        auth()->user()->departement == 'Management')
    @if ($subTitle == 'fna')
        <li class="nav-item active submenu">
        @else
        <li class="nav-item">
    @endif
    <a data-toggle="collapse" href="#finAcc">
        <i class="fas fa-calculator"></i>
        <p>Finance & Accounting</p>
        <span class="caret"></span>
    </a>
    @if ($subTitle == 'fna')
        <div class="collapse show" id="finAcc">
        @else
            <div class="collapse" id="finAcc">
    @endif
    <ul class="nav nav-collapse">
        <li class="nav-item {{ Request::is('dashboard/purchaseorders*') ? 'active' : '' }}">
            <a href="/dashboard/purchaseorders">
                <span class="sub-item">Purchase Order</span>
            </a>
        </li>
    </ul>
@endif
@if (auth()->user()->departement == 'Billing' ||
        auth()->user()->departement == 'IT' ||
        auth()->user()->departement == 'Management')
    @if ($subTitle == 'billing')
        <li class="nav-item active submenu">
        @else
        <li class="nav-item">
    @endif
    <a data-toggle="collapse" href="#bill">
        <i class="fas fa-file-invoice-dollar"></i>
        <p>Billing</p>
        <span class="caret"></span>
    </a>
    @if ($subTitle == 'billing')
        <div class="collapse show" id="bill">
        @else
            <div class="collapse" id="bill">
    @endif
    <ul class="nav nav-collapse">
        <li class="nav-item {{ Request::is('dashboard/invoice') ? 'active' : '' }}">
            <a href="/dashboard/invoice">
                <span class="sub-item">Invoice</span>
            </a>
        </li>
    </ul>
@endif
</div>
</li>
</ul>
</div>
