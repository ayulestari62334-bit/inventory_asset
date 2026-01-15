<?php

namespace Modules\AssetInventory\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->input('cari');

        $model = kategori_barang::query();

        if ($filter) {
            $model->where(function ($query) use ($filter) {
                $query->where('kode','like','%'.$filter.'%')
                    ->orWhere('nama','like','%'.$filter. '%');
            });   
        }

        $model = $model->latest()->paginate(10);

        return view('inventoryasset::kategoribarang.index', compact('model', 'filter')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('assetinventory::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('assetinventory::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('assetinventory::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
