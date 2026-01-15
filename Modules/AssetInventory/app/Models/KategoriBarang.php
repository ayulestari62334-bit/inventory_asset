<?php

namespace Modules\AssetInventory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\AssetInventory\Database\Factories\KategoriBarangFactory;

class KategoriBarang extends Model
{
    use HasFactory;
    protected $table = 'kategori_barang';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'kode_barang',
        'nama_kategori',
    ];
    // protected static function newFactory(): KategoriBarangFactory
    // {
    //     // return KategoriBarangFactory::new();
    // }
}
