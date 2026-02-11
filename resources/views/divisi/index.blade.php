@extends('layouts.app')

@section('content')

<h4 class="mb-3">Master Divisi</h4>

{{-- TOAST --}}
@if(session('success'))
<div class="toast-center toast-success" id="toast">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="toast-center toast-error" id="toast">{{ session('error') }}</div>
@endif
@if ($errors->any())
<div class="toast-center toast-error" id="toast">{{ $errors->first() }}</div>
@endif

<style>
.toast-center{
    position:fixed;
    top:50%;
    left:50%;
    transform:translate(-50%,-50%);
    padding:14px 22px;
    border-radius:10px;
    color:#fff;
    z-index:9999;
    box-shadow:0 10px 25px rgba(0,0,0,.3);
}
.toast-success{background:#28a745}
.toast-error{background:#dc3545}

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
        <strong>DATA DIVISI</strong>
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

        <p class="mb-2"><strong>Total Data :</strong> {{ $divisi->count() }}</p>

        <table class="table table-bordered table-sm">
            <thead class="bg-primary text-white text-center">
                <tr>
                    <th width="40">No</th>
                    <th>Nama Divisi</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">

            @forelse($divisi as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_divisi }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center" style="gap:6px">

                            {{-- EDIT --}}
                            <button class="btn btn-warning btn-xs"
                                    data-toggle="modal"
                                    data-target="#edit{{ $item->id }}">
                                <i class="fas fa-edit"></i>
                            </button>

                            {{-- DELETE --}}
                            <form action="{{ route('divisi.destroy',$item->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus data?')">
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
                <div class="modal fade" id="edit{{ $item->id }}">
                    <div class="modal-dialog modal-sm">
                        <form action="{{ route('divisi.update',$item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header py-2">
                                    <h6 class="modal-title">Edit Divisi</h6>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nama Divisi</label>
                                        <input class="form-control form-control-sm"
                                               name="nama_divisi"
                                               value="{{ $item->nama_divisi }}"
                                               required>
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
                    <td colspan="3" class="text-center text-muted">
                        DATA KOSONG
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
        <form action="{{ route('divisi.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h6 class="modal-title">Tambah Divisi</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Divisi</label>
                        <input class="form-control form-control-sm"
                               name="nama_divisi"
                               placeholder="Contoh: IT Support"
                               required>
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
