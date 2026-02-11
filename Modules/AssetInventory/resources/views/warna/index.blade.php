@extends('layouts.app')

@section('title','Data Warna')

@section('content')

<h4 class="mb-3">Data Warna</h4>

{{-- TOAST --}}
@if(session('success'))
<div class="toast-center toast-success" id="toast">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="toast-center toast-error" id="toast">
    {{ session('error') }}
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
.toast-error{ background:#dc3545; }

.color-box{
    width:26px;
    height:26px;
    border-radius:6px;
    border:1px solid #ccc;
    display:inline-block;
}
</style>

<div class="card">
    <div class="card-header bg-primary py-2 text-white">
        <strong>DATA WARNA</strong>
    </div>

    <div class="card-body pt-3">

        <div class="d-flex justify-content-between mb-2">
            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah
            </button>

            <input type="text" id="search"
                   class="form-control form-control-sm w-25"
                   placeholder="Cari data...">
        </div>

        <p><strong>Total Data :</strong> {{ $warna->count() }}</p>

        <table class="table table-bordered table-sm">
            <thead class="bg-primary text-white text-center">
                <tr>
                    <th width="40">No</th>
                    <th>Kode Warna</th>
                    <th>Nama Warna</th>
                    <th>Preview</th>
                    <th>Hex</th>
                    <th>Keterangan</th>
                    <th width="90">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
            @forelse($warna as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->kode_warna }}</td>
                    <td>{{ $item->nama_warna }}</td>
                    <td class="text-center">
                        <span class="color-box" style="background: {{ $item->hex_warna }}"></span>
                    </td>
                    <td>
                        <span class="badge badge-dark">{{ $item->hex_warna }}</span>
                    </td>
                    <td>{{ $item->keterangan }}</td>
                    <td class="text-center">

                        <button class="btn btn-warning btn-xs"
                                data-toggle="modal"
                                data-target="#modalEdit{{ $item->id }}">
                            <i class="fas fa-edit"></i>
                        </button>

                        <form action="{{ route('warna.destroy',$item->id) }}"
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
                    <div class="modal-dialog modal-sm">
                        <form action="{{ route('warna.update',$item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">

                                <div class="modal-header bg-primary py-2 text-white">
                                    <h6 class="modal-title">Edit Warna</h6>
                                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">

                                    <div class="form-group">
                                        <label>Nama Warna</label>
                                        <input type="text" name="nama_warna"
                                               value="{{ $item->nama_warna }}"
                                               class="form-control form-control-sm" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Hex Warna</label>
                                        <input type="color" name="hex_warna"
                                               value="{{ $item->hex_warna }}"
                                               class="form-control form-control-sm"
                                               style="height:40px" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan"
                                                  class="form-control form-control-sm">{{ $item->keterangan }}</textarea>
                                    </div>

                                </div>

                                <div class="modal-footer py-2">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                                        Batal
                                    </button>
                                    <button class="btn btn-primary btn-sm">Update</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">
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
    <div class="modal-dialog modal-sm">
        <form action="{{ route('warna.store') }}" method="POST">
            @csrf
            <div class="modal-content">

                <div class="modal-header bg-primary py-2 text-white">
                    <h6 class="modal-title">Tambah Warna</h6>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <div class="alert alert-info text-center py-2">
                        Kode dibuat otomatis
                    </div>

                    <div class="form-group">
                        <label>Nama Warna</label>
                        <input type="text" name="nama_warna"
                               class="form-control form-control-sm"
                               placeholder="Contoh: Hitam" required>
                    </div>

                    <div class="form-group">
                        <label>Hex Warna</label>
                        <input type="color" name="hex_warna"
                               class="form-control form-control-sm"
                               style="height:40px" required>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan"
                                  class="form-control form-control-sm"
                                  placeholder="Contoh: Warna standar kantor"></textarea>
                    </div>

                </div>

                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
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
