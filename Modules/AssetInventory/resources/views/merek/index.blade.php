@extends('layouts.app')

@section('title','Data Merek')

@section('content')

<h4 class="mb-3">Data Merek</h4>

{{-- TOAST --}}
@if(session('success'))
<div class="toast-center toast-success" id="toast">
    {{ session('success') }}
</div>
@endif

<style>
.toast-center{
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 16px 26px;
    border-radius: 10px;
    color: #fff;
    font-size: 15px;
    font-weight: 500;
    box-shadow: 0 8px 25px rgba(0,0,0,.3);
    z-index: 9999;
}
.toast-success{ background:#28a745; }
</style>

<div class="card">
    <div class="card-header bg-primary py-2 text-white">
        <strong>DATA MEREK</strong>
    </div>

    <div class="card-body pt-3">

        <div class="d-flex justify-content-between mb-2">
            <button class="btn btn-success btn-sm"
                    data-toggle="modal"
                    data-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah
            </button>

            <input type="text" id="search"
                   class="form-control form-control-sm w-25"
                   placeholder="Cari data...">
        </div>

        <p><strong>Total Data :</strong> {{ $merek->count() }}</p>

        <table class="table table-bordered table-sm">
            <thead class="bg-primary text-white text-center">
                <tr>
                    <th width="40">No</th>
                    <th>Kode Merek</th>
                    <th>Nama Merek</th>
                    <th>Keterangan</th>
                    <th width="90">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
            @forelse($merek as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->kode_merek }}</td>
                    <td>{{ $item->nama_merek }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td class="text-center">

                        <button class="btn btn-warning btn-xs"
                                data-toggle="modal"
                                data-target="#modalEdit{{ $item->id }}">
                            <i class="fas fa-edit"></i>
                        </button>

                        <form action="{{ route('merek.destroy',$item->id) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-xs">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>

                    </td>
                </tr>

                {{-- MODAL EDIT --}}
                <div class="modal fade" id="modalEdit{{ $item->id }}">
                    <div class="modal-dialog modal-sm modal-dialog-centered">
                        <form action="{{ route('merek.update',$item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">

                                <div class="modal-header bg-primary py-2 text-white">
                                    <h6 class="modal-title">Edit Merek</h6>
                                    <button type="button" class="close text-white" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="alert alert-info text-center py-2">
                                        Kode tidak dapat diubah
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Merek</label>
                                        <input type="text"
                                               name="nama_merek"
                                               class="form-control form-control-sm"
                                               value="{{ $item->nama_merek }}"
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan"
                                                  class="form-control form-control-sm">{{ $item->keterangan }}</textarea>
                                    </div>
                                </div>

                                <div class="modal-footer py-2">
                                    <button type="button"
                                            class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">
                                        Batal
                                    </button>
                                    <button class="btn btn-primary btn-sm">
                                        Update
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        DATA BELUM TERSEDIA
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <form action="{{ route('merek.store') }}" method="POST">
            @csrf
            <div class="modal-content">

                <div class="modal-header bg-primary py-2 text-white">
                    <h6 class="modal-title">Tambah Merek</h6>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="alert alert-info text-center py-2">
                        Kode dibuat otomatis
                    </div>

                    <div class="form-group">
                        <label>Nama Merek</label>
                        <input type="text"
                               name="nama_merek"
                               class="form-control form-control-sm"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan"
                                  class="form-control form-control-sm"></textarea>
                    </div>
                </div>

                <div class="modal-footer py-2">
                    <button type="button"
                            class="btn btn-secondary btn-sm"
                            data-dismiss="modal">
                        Batal
                    </button>
                    <button class="btn btn-primary btn-sm">
                        Simpan
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
setTimeout(() => document.getElementById('toast')?.remove(), 3000);

document.getElementById('search').addEventListener('keyup', function(){
    let v = this.value.toLowerCase();
    document.querySelectorAll('#tableBody tr').forEach(r => {
        r.style.display = r.innerText.toLowerCase().includes(v) ? '' : 'none';
    });
});
</script>

@endsection
