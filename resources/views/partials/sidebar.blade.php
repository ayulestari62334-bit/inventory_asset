<aside class="main-sidebar sidebar-dark-primary elevation-4">

    {{-- BRAND --}}
    <a href="{{ url('/dashboard') }}" class="brand-link">
        <i class="fas fa-boxes ml-2"></i>
        <span class="brand-text font-weight-bold ml-2">Inventory Asset</span>
    </a>

    <div class="sidebar">

        {{-- USER PANEL --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <div class="img-circle bg-primary text-white d-flex align-items-center justify-content-center"
                     style="width:38px;height:38px;font-weight:bold;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                <small class="text-muted">{{ auth()->user()->role }}</small>
            </div>
        </div>

        {{-- MENU --}}
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                {{-- DASHBOARD --}}
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}"
                       class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- USERS --}}
                @if(auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a href="{{ url('/users') }}"
                       class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Management User test</p>
                    </a>
                </li>
                @endif

                {{-- MASTER DATA --}}
                @php
                    $masterActive =
                        request()->is('kategori-barang*') ||
                        request()->is('jenis-barang*') ||
                        request()->is('lokasi*') ||
                        request()->is('warna*') ||
                        request()->is('merek*');
                @endphp

                <li class="nav-item has-treeview {{ $masterActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $masterActive ? 'active' : '' }}">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Master Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ url('/kategori-barang') }}"
                               class="nav-link {{ request()->is('kategori-barang*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>Data Kategori</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/jenis-barang') }}"
                               class="nav-link {{ request()->is('jenis-barang*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>Data Jenis</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/lokasi') }}"
                               class="nav-link {{ request()->is('lokasi*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-map-marker-alt"></i>
                                <p>Data Lokasi</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/warna') }}"
                               class="nav-link {{ request()->is('warna*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-palette"></i>
                                <p>Data Warna</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/merek') }}"
                               class="nav-link {{ request()->is('merek*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-industry"></i>
                                <p>Data Merek</p>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- MANAGEMENT BARANG (TERPISAH DARI MASTER DATA) --}}
                <li class="nav-item">
                    <a href="{{ url('/barang') }}"
                       class="nav-link {{ request()->is('barang*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Management Barang</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
