<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

<form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="modal-header bg-success text-white">
    <h5 class="modal-title">Tambah Data Barang</h5>
    <button type="button" class="close text-white" data-dismiss="modal">
        <span>&times;</span>
    </button>
</div>

<div class="modal-body">
<div class="row">

<div class="col-md-4 mb-2">
<input name="no_asset" class="form-control" placeholder="No Asset" required>
</div>

<div class="col-md-4 mb-2">
<select name="kategori_id" class="form-control" required>
<option value="">Pilih Kategori</option>
@foreach($kategori as $k)
<option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
@endforeach
</select>
</div>

<div class="col-md-4 mb-2">
<select name="jenis_id" class="form-control" required>
<option value="">Pilih Jenis</option>
@foreach($jenis as $j)
<option value="{{ $j->id }}">{{ $j->nama_jenis }}</option>
@endforeach
</select>
</div>

<div class="col-md-4 mb-2">
<select name="merek_id" class="form-control" required>
<option value="">Pilih Merek</option>
@foreach($merek as $m)
<option value="{{ $m->id }}">{{ $m->nama_merek }}</option>
@endforeach
</select>
</div>

<div class="col-md-4 mb-2">
<select name="warna_id" class="form-control" required>
<option value="">Pilih Warna</option>
@foreach($warna as $w)
<option value="{{ $w->id }}">{{ $w->nama_warna }}</option>
@endforeach
</select>
</div>

<div class="col-md-4 mb-2">
<select name="lokasi_id" class="form-control" required>
<option value="">Pilih Lokasi</option>
@foreach($lokasi as $l)
<option value="{{ $l->id }}">{{ $l->nama_lokasi }}</option>
@endforeach
</select>
</div>

<div class="col-md-6 mb-2">
<select name="karyawan_id" class="form-control" required>
<option value="">Pilih Karyawan</option>
@foreach($karyawan as $kr)
<option value="{{ $kr->id }}">
{{ $kr->nama_karyawan }} - {{ $kr->divisi->nama_divisi }}
</option>
@endforeach
</select>
</div>

<div class="col-md-6 mb-2">
<input name="serial_number" class="form-control" placeholder="Serial Number">
</div>

<div class="col-md-6 mb-2">
<input name="jenis_licence" class="form-control" placeholder="Jenis Licence">
</div>

<div class="col-md-6 mb-2">
<input name="kode_licence" class="form-control" placeholder="Kode Licence">
</div>

<div class="col-md-6 mb-2">
<input type="date" name="tanggal_masuk" class="form-control">
</div>

<div class="col-md-6 mb-2">
<select name="status_barang" class="form-control">
<option value="Aktif">Aktif</option>
<option value="Rusak">Rusak</option>
<option value="Hilang">Hilang</option>
</select>
</div>

<div class="col-md-12">
<input type="file" name="foto" class="form-control">
</div>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
<button type="submit" class="btn btn-success">Simpan</button>
</div>

</form>

    </div>
  </div>
</div>
