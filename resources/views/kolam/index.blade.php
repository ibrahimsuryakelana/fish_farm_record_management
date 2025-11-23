@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
  <h3 class="fw-bold mb-0">📊Data Kolam Ikan</h3>
  <a href="{{ route('kolam.create') }}" class="btn btn-success">Tambah Kolam</a>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>No</th>
      <th>No Kolam</th>
      <th>Tanggal Tanam</th>
      <th>Jumlah Ikan</th>
      <th>Ukuran Ikan</th>
      <th>Pakan/Bulan</th>
      <th>harga /kg</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($kolams as $k)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $k->no_kolam }}</td>
      <td>{{ $k->tanggal_tanam }}</td>
      <td>{{ $k->jumlah_ikan }}</td>
      <td>{{ $k->ukuran_ikan }}</td>
      <td>{{ $k->jumlah_pakan_dalam_1_bulan }}</td>
      <td>{{ $k->harga_kg }}</td>
      <td>
        <a href="{{ route('kolam.edit', $k->id_kolam) }}" class="btn btn-sm btn-primary">Edit</a>
        <form action="{{ route('kolam.destroy', $k->id_kolam) }}" method="post" style="display:inline">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $kolams->links() }}
@endsection
