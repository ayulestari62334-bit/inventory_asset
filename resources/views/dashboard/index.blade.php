@extends('layouts.app')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-semibold mb-0">
            <i class="bi bi-speedometer2 text-primary"></i> Dashboard
        </h4>
        <span class="text-muted small">
            {{ now()->translatedFormat('l, d F Y') }}
        </span>
    </div>

    <div class="row g-4">

        {{-- TOTAL USERS --}}
        <div class="col-md-4">
            <div class="card dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Users</small>
                        <h2 class="fw-bold mb-0">{{ $totalUser }}</h2>
                    </div>
                    <div class="icon-circle bg-primary text-white">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- TOTAL ADMIN --}}
        <div class="col-md-4">
            <div class="card dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Admin</small>
                        <h2 class="fw-bold mb-0">{{ $totalAdmin }}</h2>
                    </div>
                    <div class="icon-circle bg-primary text-white">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- TOTAL USER BIASA --}}
        <div class="col-md-4">
            <div class="card dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">User Biasa</small>
                        <h2 class="fw-bold mb-0">{{ $totalStaff }}</h2>
                    </div>
                    <div class="icon-circle bg-primary text-white">
                        <i class="bi bi-person-fill"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
body {
    background-color: #f8fafc;
}

/* CARD */
.dashboard-card {
    border-radius: 16px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 6px 18px rgba(15, 23, 42, 0.06);
    transition: 0.25s ease;
}

.dashboard-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 32px rgba(15, 23, 42, 0.12);
}

/* ICON */
.icon-circle {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}
</style>
@endpush
