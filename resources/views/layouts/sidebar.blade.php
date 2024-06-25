<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bold ms-2">Stock Barang</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
    @auth
        @if(auth()->user()->role == 'admin')
        <!-- Dashboards -->
        <li class="menu-item">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
        </li>
        <!-- Items -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="Dashboards">Items</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.items.index') }}" class="menu-link">
                        <div data-i18n="Basic">Items List</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.items.stockIn') }}" class="menu-link">
                        <div data-i18n="Basic">Stock In</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.items.stockOut') }}" class="menu-link">
                        <div data-i18n="Basic">Stock Out</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Category -->
        <li class="menu-item">
            <a href="{{ route('admin.category.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="Dashboards">Category</div>
            </a>
        </li>
        <!-- Supplier -->
        <li class="menu-item">
            <a href="{{ route('admin.supplier.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-group"></i>
                <div data-i18n="Dashboards">Supplier</div>
            </a>
        </li>
        <!-- Staff -->
        
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-user"></i>
                        <div data-i18n="Authentications">Staff</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('admin.staff.index') }}" class="menu-link">
                                <div data-i18n="Basic">Staff List</div>
                            </a>
                        </li>
                    </ul>
                </li>
        @else
        <li class="menu-item">
            <a href="{{ route('staff.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="Dashboards">Items</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('staff.items.index') }}" class="menu-link">
                        <div data-i18n="Basic">Items List</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('staff.items.stockIn') }}" class="menu-link">
                        <div data-i18n="Basic">Stock In</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('staff.items.stockOut') }}" class="menu-link">
                        <div data-i18n="Basic">Stock Out</div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
    @endauth

        <!-- Logout -->
        <li class="menu-item">
            <a href="{{ route('logout') }}" class="menu-link"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="menu-icon tf-icons bx bx-log-out-circle"></i>
                <div data-i18n="Dashboards">Log Out</div>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</aside>
<!-- / Menu -->