<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Karyawan;
use Illuminate\Http\Request;

// Module Asset Inventory
use Modules\AssetInventory\app\Models\KategoriBarang;
use Modules\AssetInventory\app\Models\JenisBarang;
use Modules\AssetInventory\app\Models\Merek;
use Modules\AssetInventory\app\Models\Warna;
use Modules\AssetInventory\app\Models\Lokasi;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::with([
            'kategori',
            'jenis',
            'merek',
            'warna',
            'lokasi',
            'karyawan.divisi'
        ])->latest()->get();

        return view('barang.index', [
            'barang'   => $barang,
            'kategori' => KategoriBarang::all(),
            'jenis'    => JenisBarang::all(),
            'merek'    => Merek::all(),
            'warna'    => Warna::all(),
            'lokasi'   => Lokasi::all(),
            'karyawan' => Karyawan::with('divisi')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id'    => 'required',
            'jenis_id'       => 'required',
            'merek_id'       => 'required',
            'warna_id'       => 'required',
            'lokasi_id'      => 'required',
            'karyawan_id'    => 'required',
            'serial_number' => 'required|unique:barang,serial_number',
            'jenis_licence' => 'required',
            'kode_licence'  => 'required',
            'tanggal_masuk' => 'required|date',
            'foto'          => 'nullable|image|max:2048'
        ]);

        // ==========================
        // GENERATE NOMOR ASSET OTOMATIS
        // ==========================
        $lastBarang = Barang::orderBy('id', 'desc')->first();
        $urutan = $lastBarang ? ((int) substr($lastBarang->no_asset, -3)) + 1 : 1;
        $urutan = str_pad($urutan, 3, '0', STR_PAD_LEFT);

        $noAsset = 
            $request->kategori_id . '-' .
            $request->jenis_id . '-' .
            $request->merek_id . '-' .
            $request->warna_id . '-' .
            $urutan;

        // ==========================
        // UPLOAD FOTO
        // ==========================
        $fotoName = null;
        if ($request->hasFile('foto')) {
            $fotoName = time() . '_' . uniqid() . '.' . $request->foto->extension();
            $request->foto->move(public_path('barang'), $fotoName);
        }

        // ==========================
        // SIMPAN DATA BARANG
        // ==========================
        Barang::create([
            'no_asset'       => $noAsset,
            'kategori_id'    => $request->kategori_id,
            'jenis_id'       => $request->jenis_id,
            'merek_id'       => $request->merek_id,
            'warna_id'       => $request->warna_id,
            'lokasi_id'      => $request->lokasi_id,
            'karyawan_id'    => $request->karyawan_id,
            'foto'           => $fotoName,
            'serial_number' => $request->serial_number,
            'jenis_licence' => $request->jenis_licence,
            'kode_licence'  => $request->kode_licence,
            'tanggal_masuk' => $request->tanggal_masuk,
            'status_barang' => 'Belum STO'
        ]);

        return back()->with('success', 'Barang berhasil ditambahkan');
    }
}
