@extends('layouts.app')

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Kategori Barang</h3>
        <div class="card-tools">
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah
            </button>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Kategori</th>
                    <th>Keterangan</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategori as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kode_barang }}</td>
                    <td>{{ $item->nama_kategori }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal"
                            data-target="#modalEdit{{ $item->id }}">
                            Edit
                        </button>

                        <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus data?')">Hapus</button>
                        </form>
                    </td>
                </tr>

                {{-- MODAL EDIT --}}
                <div class="modal fade" id="modalEdit{{ $item->id }}">
                    <div class="modal-dialog">
                        <form action="{{ route('kategori.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Kategori</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Kode Barang</label>
                                        <input type="text" name="kode_barang" class="form-control"
                                            value="{{ $item->kode_barang }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Kategori</label>
                                        <input type="text" name="nama_kategori" class="form-control"
                                            value="{{ $item->nama_kategori }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan" class="form-control">{{ $item->keterangan }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Barang</label>
                        <input type="text" name="kode_barang" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
