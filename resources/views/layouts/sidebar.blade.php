<!-- Sidebar user (optional) -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
    </div>
</div>

<!-- SidebarSearch Form -->
<div class="form-inline">
    <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
            </button>
        </div>
    </div>
</div>

<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item {{ request()->segment(1) == 'category' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->segment(1) == 'category' ? 'active' : '' }}">
                <i class="nav-icon bi bi-bookmark-check"></i>
                <p>
                    Category
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @if (akses('view-category'))
                    <li class="nav-item">
                        <a href="{{ url('category/index') }}"
                            class="nav-link {{ request()->segment(1) == 'category' && request()->segment(2) == 'index' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List Categories</p>
                        </a>
                    </li>
                @endif
            </ul>
        </li>

        <li class="nav-item {{ request()->segment(1) == 'product' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->segment(1) == 'product' ? 'active' : '' }}">
                <i class="nav-icon bi bi-box-seam"></i>
                <p>
                    Data Produk
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @if (akses('view-data-product'))
                    <li class="nav-item">
                        <a href="{{ url('product/index') }}"
                            class="nav-link {{ request()->segment(1) == 'product' && request()->segment(2) == 'index' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List Data</p>
                        </a>
                    </li>
                @endif
            </ul>
        </li>

        <li class="nav-item {{ request()->segment(1) == 'penghuni' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->segment(1) == 'penghuni' ? 'active' : '' }}">
                <i class="nav-icon bi bi-house-door"></i>
                <p>
                    Penghuni
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @if (akses('view-penghuni'))
                    <li class="nav-item">
                        <a href="{{ url('penghuni/index') }}"
                            class="nav-link {{ request()->segment(1) == 'penghuni' && request()->segment(2) == 'index' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List Penghuni</p>
                        </a>
                    </li>
                @endif

                @if (akses('create-penghuni'))
                    <li class="nav-item">
                        <a href="{{ url('penghuni/create') }}"
                            class="nav-link {{ request()->segment(1) == 'penghuni' && request()->segment(2) == 'create' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Tambah Penghuni</p>
                        </a>
                    </li>
                @endif
            </ul>
        </li>

        <li class="nav-item {{ request()->segment(1) == 'tagihan' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->segment(1) == 'tagihan' ? 'active' : '' }}">
                <i class="nav-icon bi bi-paypal"></i>
                <p>
                    Tagihan
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @if (akses('view-tagihan'))
                    <li class="nav-item">
                        <a href="{{ url('tagihan/index') }}"
                            class="nav-link {{ request()->segment(1) == 'tagihan' && request()->segment(2) == 'index' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List Tagihan</p>
                        </a>
                    </li>
                @endif
            </ul>
        </li>

        @if (akses('view-kas'))
            <li class="nav-item">
                <a href="{{ url('kasbank/index') }}"
                    class="nav-link {{ request()->segment(1) == 'kasbank' ? 'active' : '' }}"">
                <i class="          bi bi-cash-coin"></i>
                    <p>
                        Kas
                    </p>
                </a>
            </li>
        @endif

        <li class="nav-item {{ request()->segment(1) == 'reports' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->segment(1) == 'reports' ? 'active' : '' }}">
                <i class="bi bi-paperclip"></i>
                <p>
                    Reports
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @if (akses('view-laba-rugi'))
                    <li class="nav-item">
                        <a href="{{ url('reports/labarugi') }}"
                            class="nav-link {{ request()->segment(1) == 'reports' && request()->segment(2) == 'labarugi' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Laba Rugi</p>
                        </a>
                    </li>
                @endif
            </ul>
        </li>

        <li class="nav-item {{ request()->segment(1) == 'users' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->segment(1) == 'users' ? 'active' : '' }}">
                <i class="nav-icon bi bi-people"></i>
                <p>
                    User & Role
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @if (akses('view-users'))
                    <li class="nav-item">
                        <a href="{{ url('users/index') }}"
                            class="nav-link {{ request()->segment(1) == 'users' && request()->segment(2) == 'index' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manage Users</p>
                        </a>
                    </li>
                @endif

                @if (akses('view-roles'))
                    <li class="nav-item">
                        <a href="{{ url('users/roles') }}"
                            class="nav-link {{ request()->segment(1) == 'users' && request()->segment(2) == 'roles' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manage Role</p>
                        </a>
                    </li>
                @endif
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ url('settings/general-settings') }}"
                class="nav-link {{ request()->segment(1) == 'settings' ? 'active' : '' }}"">
                <i class="                nav-icon bi-gear"></i>
                <p>
                    General Settings
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ url('keluar') }}" class="nav-link">
                <i class="nav-icon bi-layer-backward"></i>
                <p>
                    Logout
                </p>
            </a>
        </li>

    </ul>
</nav>
<!-- /.sidebar-menu -->
