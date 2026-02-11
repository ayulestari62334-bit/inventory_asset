@extends('layouts.app')

@section('content')

<h4 class="mb-3">Edit User</h4>

<div class="card">
    <div class="card-header bg-primary py-2 text-white">
        <strong>EDIT DATA USER</strong>
    </div>

    <div class="card-body pt-3">

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="form-group">
                <label>Nama</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $user->name) }}"
                       required>
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label>Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email', $user->email) }}"
                       required>
            </div>

            {{-- ROLE (HANYA ADMIN BOLEH LIHAT & UBAH) --}}
            @if(auth()->user()->role === 'admin')
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control" required>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                            Admin
                        </option>
                        <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>
                            User
                        </option>
                    </select>
                </div>
            @endif

            {{-- BUTTON --}}
            <div class="mt-3">
                <button class="btn btn-primary">
                    <i class="bi bi-save"></i> Update
                </button>

                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
