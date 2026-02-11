@extends('layouts.app')

@section('content')

<h4 class="mb-3">Data Users</h4>

@if(session('success'))
<div class="toast-center toast-success" id="toast">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="toast-center toast-error" id="toastError">
    {{ session('error') }}
</div>
@endif

<style>
.toast-center{
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 16px 30px;
    border-radius: 12px;
    color: #fff;
    font-weight: 600;
    font-size: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,.35);
    z-index: 99999;
    animation: pop .3s ease;
}
.toast-success{ background:#28a745; }
.toast-error{ background:#dc3545; }

@keyframes pop{
    from{transform:translate(-50%,-60%) scale(.9);opacity:0}
    to{transform:translate(-50%,-50%) scale(1);opacity:1}
}
</style>

<div class="card">
<div class="card-header bg-primary py-2 text-white">
<strong>DATA USERS</strong>
</div>

<div class="card-body">

<div class="d-flex justify-content-between mb-2">

@if(auth()->user()->role === 'admin')
<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalTambahUser">
+ Tambah
</button>
@endif

<input type="text" id="search" class="form-control form-control-sm w-25" placeholder="Cari...">
</div>

<p><strong>Total Data :</strong> {{ $users->count() }}</p>

<table class="table table-bordered table-sm">
<thead class="bg-primary text-white text-center">
<tr>
<th width="40">No</th>
<th>Nama</th>
<th>Email</th>
<th width="100">Role</th>
<th width="90">Aksi</th>
</tr>
</thead>
<tbody id="tableBody">

@foreach($users as $u)
<tr>
<td class="text-center">{{ $loop->iteration }}</td>
<td>{{ $u->name }}</td>
<td>{{ $u->email }}</td>
<td class="text-center">
<span class="badge badge-{{ $u->role=='admin'?'primary':'secondary' }}">
{{ ucfirst($u->role) }}
</span>
</td>
<td class="text-center">

@if(auth()->user()->role === 'admin')
<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modalEdit{{ $u->id }}">✏</button>
@endif

@if(auth()->id() !== $u->id)
<form action="{{ route('users.destroy',$u->id) }}" method="POST" class="d-inline"
onsubmit="return confirm('Hapus user ini?')">
@csrf
@method('DELETE')
<button class="btn btn-danger btn-xs">🗑</button>
</form>
@endif

</td>
</tr>

{{-- ✅ MODAL EDIT (INI YANG SEBELUMNYA HILANG) --}}
<div class="modal fade" id="modalEdit{{ $u->id }}" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header bg-warning">
<h5>Edit User</h5>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<form action="{{ route('users.update',$u->id) }}" method="POST">
@csrf
@method('PUT')

<div class="modal-body">

<div class="form-group">
<label>Nama</label>
<input type="text" name="name" class="form-control" value="{{ $u->name }}" required>
</div>

<div class="form-group">
<label>Email</label>
<input type="email" name="email" class="form-control" value="{{ $u->email }}" required>
</div>

<div class="form-group">
<label>Role</label>
<select name="role" class="form-control" required>
<option value="admin" {{ $u->role=='admin'?'selected':'' }}>Admin</option>
<option value="user" {{ $u->role=='user'?'selected':'' }}>User</option>
</select>
</div>

</div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
<button class="btn btn-warning">Update</button>
</div>

</form>

</div>
</div>
</div>

@endforeach

</tbody>
</table>

</div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambahUser" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header bg-primary text-white">
<h5>Tambah User</h5>
<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
</div>

<form action="{{ route('users.store') }}" method="POST">
@csrf
<div class="modal-body">

<div class="form-group">
<label>Nama</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="form-group">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="form-group">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<div class="form-group">
<label>Role</label>
<select name="role" class="form-control" required>
<option value="admin">Admin</option>
<option value="user">User</option>
</select>
</div>

</div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
<button class="btn btn-primary">Simpan</button>
</div>
</form>

</div>
</div>
</div>

<script>
setTimeout(()=>{
 let s=document.getElementById('toast');
 let e=document.getElementById('toastError');
 if(s) s.remove();
 if(e) e.remove();
},3000);

document.getElementById('search').addEventListener('keyup',function(){
 let v=this.value.toLowerCase();
 document.querySelectorAll('#tableBody tr').forEach(r=>{
  r.style.display=r.innerText.toLowerCase().includes(v)?'':'none';
 });
});
</script>

@endsection
