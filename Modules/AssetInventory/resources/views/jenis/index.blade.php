@extends('layouts.app')

@section('title','Data Jenis Barang')

@section('content')

<h4 class="mb-3">Data Jenis Barang</h4>

@if(session('success'))
<div class="toast-center toast-success" id="toast">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="toast-center toast-error" id="toast">{{ session('error') }}</div>
@endif

<style>
.toast-center{
    position:fixed;
    top:50%;left:50%;
    transform:translate(-50%,-50%);
    padding:14px 22px;
    border-radius:10px;
    color:#fff;
    z-index:9999;
    box-shadow:0 10px 25px rgba(0,0,0,.3);
}
.toast-success{background:#28a745}
.toast-error{background:#dc3545}

.kode-tipis{
    font-weight:400;
    letter-spacing:.4px;
}

.modal-header{
    background:#007bff;
    color:#fff;
}
.modal-header .close{
    color:#fff;
    opacity:.8;
}
</style>

<div class="card shadow-sm">
    <div class="card-header bg-primary py-2 text-white">
        <strong>DATA JENIS BARANG</strong>
    </div>

    <div class="card-body">

        <div class="d-flex justify-content-between mb-2">
            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah
            </button>

            <input type="text" id="search"
                   class="form-control form-control-sm w-25"
                   placeholder="Cari data...">
        </div>

        <p class="mb-2"><strong>Total Data :</strong> {{ $jenis->count() }}</p>

        <table class="table table-bordered table-sm">
            <thead class="bg-primary text-white text-center">
                <tr>
                    <th width="40">No</th>
                    <th>Kode Jenis</th>
                    <th>Nama Jenis</th>
                    <th>Keterangan</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
            @forelse($jenis as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="kode-tipis">{{ $item->kode_jenis }}</td>
                    <td>{{ $item->nama_jenis }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center" style="gap:6px">

                            {{-- EDIT --}}
                            <button class="btn btn-warning btn-xs"
                                    data-toggle="modal"
                                    data-target="#modalEdit{{ $item->id }}">
                                <i class="fas fa-edit"></i>
                            </button>

                            {{-- DELETE --}}
                            <form action="{{ route('jenis.destroy',$item->id) }}"
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
                        <form action="{{ route('jenis.update',$item->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="modal-content">
                                <div class="modal-header py-2">
                                    <h6 class="modal-title">Edit Jenis Barang</h6>
                                    <button class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">
                                    <input type="hidden" name="kode_jenis" value="{{ $item->kode_jenis }}">

                                    <div class="form-group">
                                        <label>Nama Jenis</label>
                                        <input class="form-control form-control-sm"
                                               name="nama_jenis"
                                               value="{{ $item->nama_jenis }}"
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
        <form action="{{ route('jenis.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h6 class="modal-title">Tambah Jenis Barang</h6>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <button class="btn btn-info btn-sm btn-block mb-3" disabled>
                        Kode dibuat otomatis
                    </button>

                    <div class="form-group">
                        <label>Nama Jenis</label>
                        <input class="form-control form-control-sm"
                               name="nama_jenis"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control form-control-sm"
                                  name="keterangan"
                                  rows="3"></textarea>
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
setTimeout(()=>document.getElementById('toast')?.remove(),3000);

document.getElementById('search').addEventListener('keyup',function(){
    let v=this.value.toLowerCase();
    document.querySelectorAll('#tableBody tr').forEach(r=>{
        r.style.display = r.innerText.toLowerCase().includes(v) ? '' : 'none';
    });
});
</script>

@endsection
