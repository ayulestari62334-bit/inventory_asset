@extends('layouts.app')

@section('title','Data Lokasi')

@section('content')

<h4 class="mb-3">Data Lokasi</h4>

{{-- TOAST --}}
@if(session('success'))
<div class="toast-center toast-success" id="toast">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="toast-center toast-error" id="toast">{{ session('error') }}</div>
@endif

<style>
.toast-center{
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 14px 24px;
    border-radius: 10px;
    color: #fff;
    font-size: 14px;
    box-shadow: 0 10px 25px rgba(0,0,0,.3);
    z-index: 9999;
}
.toast-success{ background:#28a745; }
.toast-error{ background:#dc3545; }

.kode-tipis{
    font-weight: 400;
    letter-spacing: .4px;
}

.aksi-btn{
    display: flex;
    justify-content: center;
    gap: 6px;
}
.btn-xs{
    padding: 4px 7px;
    font-size: 12px;
}

.modal-content{ border-radius: 10px; }
.modal-header{
    background: #007bff;
    color: #fff;
}
.modal-header .close{
    color:#fff;
    opacity:.8;
}

.btn-kode{
    background: #17a2b8;
    color: #fff;
    border: none;
    font-size: 13px;
}
</style>

<div class="card shadow-sm">
    <div class="card-header bg-primary py-2 text-white">
        <strong>DATA LOKASI</strong>
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

        <p class="mb-2"><strong>Total Data :</strong> {{ $lokasi->count() }}</p>

        <table class="table table-bordered table-sm">
            <thead class="bg-primary text-white text-center">
                <tr>
                    <th width="40">No</th>
                    <th>Kode Lokasi</th>
                    <th>Nama Lokasi</th>
                    <th>Keterangan</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
            @forelse($lokasi as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="kode-tipis">{{ $item->kode_lokasi }}</td>
                    <td>{{ $item->nama_lokasi }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                    <td class="text-center">
                        <div class="aksi-btn">

                            {{-- EDIT --}}
                            <button class="btn btn-warning btn-xs"
                                    data-toggle="modal"
                                    data-target="#modalEdit{{ $item->id }}">
                                <i class="fas fa-edit"></i>
                            </button>

                            {{-- DELETE --}}
                            <form action="{{ route('lokasi.destroy',$item->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-xs">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>

                {{-- MODAL EDIT --}}
                <div class="modal fade" id="modalEdit{{ $item->id }}">
                    <div class="modal-dialog modal-sm">
                        <form action="{{ route('lokasi.update',$item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header py-2">
                                    <h6 class="modal-title">Edit Lokasi</h6>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nama Lokasi</label>
                                        <input class="form-control form-control-sm"
                                               name="nama_lokasi"
                                               value="{{ $item->nama_lokasi }}"
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea class="form-control form-control-sm"
                                                  name="keterangan"
                                                  rows="3">{{ $item->keterangan }}</textarea>
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
    <div class="modal-dialog modal-sm">
        <form action="{{ route('lokasi.store') }}" method="POST">
            @csrf
            <div class="modal-content">

                <div class="modal-header py-2">
                    <h6 class="modal-title">Tambah Data Lokasi</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <button type="button" class="btn btn-kode btn-sm btn-block mb-3" disabled>
                        Kode dibuat otomatis
                    </button>

                    <div class="form-group">
                        <label>Nama Lokasi</label>
                        <input type="text"
                               name="nama_lokasi"
                               class="form-control form-control-sm"
                               placeholder="Contoh: Gudang"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan"
                                  class="form-control form-control-sm"
                                  placeholder="Contoh: Lokasi penyimpanan barang"></textarea>
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
setTimeout(()=>document.getElementById('toast')?.remove(),3000);

document.getElementById('search').addEventListener('keyup',function(){
    let v=this.value.toLowerCase();
    document.querySelectorAll('#tableBody tr').forEach(r=>{
        r.style.display = r.innerText.toLowerCase().includes(v) ? '' : 'none';
    });
});
</script>

@endsection
