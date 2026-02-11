<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title','Inventory Asset')</title>

    {{-- AdminLTE --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    {{-- ✅ FIX KLIK TOMBOL ADMINLTE --}}
    <style>
        .table td button,
        .table td a{
            position: relative;
            z-index: 10;
        }

        .sidebar-overlay{
            pointer-events: none !important;
        }
    </style>

    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

{{-- ================= NAVBAR ================= --}}
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger btn-sm">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</nav>

{{-- ================= SIDEBAR ================= --}}
<aside class="main-sidebar sidebar-light-primary elevation-2">

    <a href="{{ route('dashboard') }}" class="brand-link text-center">
        <i class="fas fa-boxes mr-1"></i>
        <span class="brand-text font-weight-bold">Inventory Asset</span>
    </a>

    <div class="sidebar">

        {{-- USER PANEL --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                     style="width:40px;height:40px;font-weight:bold;">
                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                </div>
            </div>

            <div class="info ml-2">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                <small class="text-muted">{{ auth()->user()->role }}</small>
            </div>
        </div>

        {{-- MENU --}}
        @php
            $masterActive = request()->is(
                'kategori-barang*',
                'jenis-barang*',
                'lokasi*',
                'warna*',
                'merek*',
                'divisi*',
                'karyawan*'
            );
        @endphp

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                {{-- DASHBOARD --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                       class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- USERS --}}
                <li class="nav-item">
                    <a href="{{ route('users.index') }}"
                       class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>

                {{-- MASTER DATA --}}
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
                            <a href="{{ url('divisi') }}"
                               class="nav-link {{ request()->is('divisi*') ? 'active' : '' }}">
                                <i class="bi bi-diagram-3 nav-icon"></i>
                                <p>Data Divisi</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('karyawan') }}"
                               class="nav-link {{ request()->is('karyawan*') ? 'active' : '' }}">
                                <i class="bi bi-people nav-icon"></i>
                                <p>Data Karyawan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('kategori-barang') }}"
                               class="nav-link {{ request()->is('kategori-barang*') ? 'active' : '' }}">
                                <i class="fas fa-tags nav-icon"></i>
                                <p>Data Kategori</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('jenis-barang') }}"
                               class="nav-link {{ request()->is('jenis-barang*') ? 'active' : '' }}">
                                <i class="fas fa-layer-group nav-icon"></i>
                                <p>Data Jenis</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('lokasi') }}"
                               class="nav-link {{ request()->is('lokasi*') ? 'active' : '' }}">
                                <i class="fas fa-map-marker-alt nav-icon"></i>
                                <p>Data Lokasi</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('warna') }}"
                               class="nav-link {{ request()->is('warna*') ? 'active' : '' }}">
                                <i class="fas fa-palette nav-icon"></i>
                                <p>Data Warna</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('merek') }}"
                               class="nav-link {{ request()->is('merek*') ? 'active' : '' }}">
                                <i class="fas fa-copyright nav-icon"></i>
                                <p>Data Merek</p>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- MANAGEMENT BARANG --}}
                <li class="nav-item">
                    <a href="{{ url('barang') }}"
                       class="nav-link {{ request()->is('barang*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Management Barang</p>
                    </a>
                </li>

            </ul>
        </nav>

    </div>
</aside>

{{-- ================= CONTENT ================= --}}
<div class="content-wrapper p-3">
    @yield('content')
</div>

</div>

{{-- ================= JS ================= --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

@stack('scripts')

</body>
</html>
