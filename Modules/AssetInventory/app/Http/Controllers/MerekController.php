<?php

namespace Modules\AssetInventory\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\AssetInventory\app\Models\Merek;

class MerekController extends Controller
{
    public function index()
    {
        $merek = Merek::latest()->get();
        return view('assetinventory::merek.index', compact('merek'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_merek' => 'required|unique:mereks,nama_merek',
            'keterangan' => 'nullable',
        ]);

        // KODE OTOMATIS
        $last = Merek::latest()->first();
        $kode = 'MRK-' . str_pad(($last ? $last->id + 1 : 1), 3, '0', STR_PAD_LEFT);

        Merek::create([
            'kode_merek' => $kode,
            'nama_merek' => $request->nama_merek,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('merek.index')
            ->with('success', 'Merek berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $merek = Merek::findOrFail($id);

        $request->validate([
            'nama_merek' => 'required|unique:mereks,nama_merek,' . $merek->id,
            'keterangan' => 'nullable',
        ]);

        $merek->update([
            'nama_merek' => $request->nama_merek,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('merek.index')
            ->with('success', 'Merek berhasil diupdate');
    }

    public function destroy($id)
    {
        Merek::findOrFail($id)->delete();

        return redirect()->route('merek.index')
            ->with('success', 'Merek berhasil dihapus');
    }
}
