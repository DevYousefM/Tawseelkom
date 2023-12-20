<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light">لوحة التحكم | {{ auth()->user()->name }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            الرئيسية
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('deliveries') }}" class="nav-link">
                        <i class="nav-icon fas fa-shipping-fast"></i>
                        <p>
                            المندوبين
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('areas') }}" class="nav-link">
                        <i class="nav-icon fas fa-city"></i>
                        <p>
                            المراكز
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('shipment_types') }}" class="nav-link">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>
                            انواع الشحنات
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('routes') }}" class="nav-link">
                        <i class="nav-icon fas fa-route"></i>
                        <p>
                            المسارات
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('orders') }}" class="nav-link">
                        <i class="nav-icon fas fa-shopping-basket"></i>
                        <p>
                            الطلبات
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
