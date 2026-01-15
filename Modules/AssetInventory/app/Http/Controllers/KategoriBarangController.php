<?php

namespace Modules\AssetInventory\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AssetInventory\app\Models\KategoriBarang;

class KategoriBarangController extends Controller
{

    public function index()
    {
        $kategori = KategoriBarang::all();
        return view('assetinventory::kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang'   => 'required',
            'nama_kategori' => 'required',
            'keterangan'    => 'required',
        ]);

        KategoriBarang::create([
            'kode_barang'   => $request->kode_barang,
            'nama_kategori' => $request->nama_kategori,
            'keterangan'    => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_barang'   => 'required',
            'nama_kategori' => 'required',
            'keterangan'    => 'required',
        ]);

        $kategori = KategoriBarang::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->back()->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy($id)
    {
        KategoriBarang::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }
}