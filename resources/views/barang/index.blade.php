@extends('layouts.app')

@section('content')
<div class="container-fluid">

<h4 class="mb-3 fw-bold">Master Data Barang</h4>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm border-0">

<div class="card-header bg-primary text-white">
<strong>DATA BARANG</strong>
</div>

<div class="card-body">

<div class="d-flex justify-content-between align-items-center mb-2">

<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalTambah">
+ Tambah
</button>

<input type="text" class="form-control w-25" placeholder="Cari data...">

</div>

<p><b>Total Data : {{ $barang->count() }}</b></p>

<div class="table-responsive">
<table class="table table-bordered table-hover text-center">

<thead class="bg-primary text-white">
<tr>
<th>No</th>
<th>No Asset</th>
<th>Kategori</th>
<th>Jenis</th>
<th>Merek</th>
<th>Warna</th>
<th>Lokasi</th>
<th>ID</th>
<th>Karyawan</th>
<th>Divisi</th>
<th>Foto</th>
<th>Serial</th>
<th>Licence</th>
<th>Kode</th>
<th>Tanggal</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>

@if($barang->isEmpty())
<tr>
<td colspan="17">DATA KOSONG</td>
</tr>
@else

@foreach($barang as $b)
<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $b->no_asset }}</td>
<td>{{ $b->kategori->nama_kategori }}</td>
<td>{{ $b->jenis->nama_jenis }}</td>
<td>{{ $b->merek->nama_merek }}</td>
<td>{{ $b->warna->nama_warna }}</td>
<td>{{ $b->lokasi->nama_lokasi }}</td>
<td>{{ $b->karyawan->id_karyawan }}</td>
<td>{{ $b->karyawan->nama_karyawan }}</td>
<td>{{ $b->karyawan->divisi->nama_divisi }}</td>

<td>
@if($b->foto)
<img src="{{ asset('barang/'.$b->foto) }}" width="60">
@else
-
@endif
</td>

<td>{{ $b->serial_number }}</td>
<td>{{ $b->jenis_licence }}</td>
<td>{{ $b->kode_licence }}</td>
<td>{{ $b->tanggal_masuk }}</td>

<td>
<span class="badge badge-warning">{{ $b->status_barang }}</span>
</td>

<td>

<button class="btn btn-warning btn-sm"
data-toggle="modal"
data-target="#modalEdit{{ $b->id }}">
Edit
</button>

<form action="{{ route('barang.destroy',$b->id) }}" method="POST" style="display:inline;">
@csrf
@method('DELETE')
<button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">
Hapus
</button>
</form>

</td>
</tr>

{{-- ================= MODAL EDIT ================= --}}
<div class="modal fade" id="modalEdit{{ $b->id }}">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<form action="{{ route('barang.update',$b->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="modal-header bg-warning">
<h5>Edit Barang</h5>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<div class="modal-body row">

<div class="col-md-4 mb-2">
<select name="kategori_id" class="form-control">
@foreach($kategori as $k)
<option value="{{ $k->id }}" {{ $b->kategori_id==$k->id?'selected':'' }}>
{{ $k->nama_kategori }}
</option>
@endforeach
</select>
</div>

<div class="col-md-4 mb-2">
<select name="jenis_id" class="form-control">
@foreach($jenis as $j)
<option value="{{ $j->id }}" {{ $b->jenis_id==$j->id?'selected':'' }}>
{{ $j->nama_jenis }}
</option>
@endforeach
</select>
</div>

<div class="col-md-4 mb-2">
<select name="merek_id" class="form-control">
@foreach($merek as $m)
<option value="{{ $m->id }}" {{ $b->merek_id==$m->id?'selected':'' }}>
{{ $m->nama_merek }}
</option>
@endforeach
</select>
</div>

<div class="col-md-4 mb-2">
<select name="warna_id" class="form-control">
@foreach($warna as $w)
<option value="{{ $w->id }}" {{ $b->warna_id==$w->id?'selected':'' }}>
{{ $w->nama_warna }}
</option>
@endforeach
</select>
</div>

<div class="col-md-4 mb-2">
<select name="lokasi_id" class="form-control">
@foreach($lokasi as $l)
<option value="{{ $l->id }}" {{ $b->lokasi_id==$l->id?'selected':'' }}>
{{ $l->nama_lokasi }}
</option>
@endforeach
</select>
</div>

<div class="col-md-4 mb-2">
<select name="karyawan_id" class="form-control">
@foreach($karyawan as $k)
<option value="{{ $k->id }}" {{ $b->karyawan_id==$k->id?'selected':'' }}>
{{ $k->nama_karyawan }}
</option>
@endforeach
</select>
</div>

<div class="col-md-6 mb-2">
<input name="serial_number" value="{{ $b->serial_number }}" class="form-control">
</div>

<div class="col-md-6 mb-2">
<input name="jenis_licence" value="{{ $b->jenis_licence }}" class="form-control">
</div>

<div class="col-md-6 mb-2">
<input name="kode_licence" value="{{ $b->kode_licence }}" class="form-control">
</div>

<div class="col-md-6 mb-2">
<input type="date" name="tanggal_masuk" value="{{ $b->tanggal_masuk }}" class="form-control">
</div>

<div class="col-md-12">
<input type="file" name="foto" class="form-control">
</div>

</div>

<div class="modal-footer">
<button class="btn btn-secondary" data-dismiss="modal">Batal</button>
<button class="btn btn-warning">Update</button>
</div>

</form>

</div>
</div>
</div>

@endforeach
@endif

</tbody>
</table>
</div>

</div>
</div>
</div>

@include('barang.partials.modal-tambah')

@endsection
