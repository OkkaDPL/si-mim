<div class="sidebar-content">
    <ul class="nav">
        @if ($title == 'Dashboard')
            <li class="nav-item active">
            @else
            <li class="nav-item">
        @endif
        <a href="/dashboard">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
            <span class="badge badge-count">5</span>
        </a>
        </li>
        <li class="nav-section">
            <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">fiturs</h4>
        </li>
        @if ($title == 'Master')
            <li class="nav-item active submenu">
            @else
            <li class="nav-item">
        @endif
        <a data-toggle="collapse" href="#base">
            <i class="fas fa-layer-group"></i>
            <p>Master Data</p>
            <span class="caret"></span>
        </a>
        @if ($title == 'Master')
            <div class="collapse show" id="base">
            @else
                <div class="collapse" id="base">
        @endif
        <ul class="nav nav-collapse">
            @if ($subTitle == 'Data Users')
                <li class="nav-item active">
                @else
                <li class="nav-item">
            @endif
            <a href="/dashboard/users">
                <span class="sub-item">User</span>
            </a>
            </li>
            <li>
                <a href="/dashboard/employees">
                    <span class="sub-item">Employee</span>
                </a>
            </li>
            <li>
                <a href="/dashboard/principals">
                    <span class="sub-item">Principal</span>
                </a>
            </li>
            <li>
                <a href="/dashboard/customers">
                    <span class="sub-item">Customer</span>
                </a>
            </li>
            <li>
                <a href="/dashboard/divisions">
                    <span class="sub-item">Division</span>
                </a>
            </li>
            <li>
                <a href="/dashboard/categories">
                    <span class="sub-item">Category</span>
                </a>
            </li>
            <li>
                <a href="/dashboard/parts">
                    <span class="sub-item">Part</span>
                </a>
            </li>
            <li>
                <a href="/dashboard/lots">
                    <span class="sub-item">LOT</span>
                </a>
            </li>
            <li>
                <a href="/dashboard/products">
                    <span class="sub-item">Product</span>
                </a>
            </li>
            <li>
                <a href="/dashboard/warehouses">
                    <span class="sub-item">Warehouse</span>
                </a>
            </li>
            <li>
                <a href="/dashboard/bins">
                    <span class="sub-item">Bin</span>
                </a>
            </li>
        </ul>
</div>
</li>
<li class="nav-item">
    <a data-toggle="collapse" href="#forms">
        <i class="fas fa-pen-square"></i>
        <p>Forms</p>
        <span class="caret"></span>
    </a>
    <div class="collapse" id="forms">
        <ul class="nav nav-collapse">
            <li>
                <a href="/user">
                    <span class="sub-item">User</span>
                </a>
            </li>
            <li>
                <a href="/fm/product">
                    <span class="sub-item">Product</span>
                </a>
            </li>

        </ul>
    </div>
</li>
</ul>
</div>
