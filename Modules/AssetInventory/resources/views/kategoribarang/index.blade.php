
@extends('layouts.app')

@section('content')
    <h2>Data kategori</h2>

    <form method="GET" action="{{ route('modul') }}">
        <input
            type="text"
            name="cari"
            value="{{ $filter }}"
            placeholder="Cari nama / deskripsi..."
        >
        <button type="submit">Cari</button>
        @if($filter)
            <a href="{{ route('modul') }}">Reset</a>
        @endif
</form>

<br>

<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Kode Barang</th>
            <th>Nama Kategori</th>
            <th>Keterangan</th>
            <th>Dibuat</th>
        </tr>
    </thead>
        @forelse (model as $item)
            <tr>
                <td>{{ $loop->iteration + (model->currentPage() -1) * $model->perPage() }}</td>
                <td>{{ $item->kode barang }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->deskripsi}}</td>
                <td>{{ $item->created_at?->format('D M Y')}}</td>
            </tr>
        @empty
        <tr>
            <td colspan="4" align="center">Data tidak ditemukan</td>
        </tr> 
        @endforelse
    </tbody>
</table>

<br>

    {{ $filter->withQueryString()->links() }}
@endsection
