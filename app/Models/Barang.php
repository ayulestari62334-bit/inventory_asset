<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// IMPORT DARI MODULE
use Modules\AssetInventory\app\Models\KategoriBarang;
use Modules\AssetInventory\app\Models\JenisBarang;
use Modules\AssetInventory\app\Models\Merek;
use Modules\AssetInventory\app\Models\Warna;
use Modules\AssetInventory\app\Models\Lokasi;

use App\Models\Karyawan;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'no_asset',
        'kategori_id',
        'jenis_id',
        'merek_id',
        'warna_id',
        'lokasi_id',
        'karyawan_id',
        'foto',
        'serial_number',
        'jenis_licence',
        'kode_licence',
        'tanggal_masuk',
        'status_barang'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_id');
    }

    public function jenis()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_id');
    }

    public function merek()
    {
        return $this->belongsTo(Merek::class, 'merek_id');
    }

    public function warna()
    {
        return $this->belongsTo(Warna::class, 'warna_id');
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}
