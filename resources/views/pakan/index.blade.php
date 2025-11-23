@extends('layouts.app')

@section('content')

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
  <h3 class="fw-bold mb-0">📊 Data Pakan</h3>
  <a href="{{ route('pakan.create') }}" class="btn btn-success">
    <i class="bi bi-plus-circle"></i> Tambah Data Pakan
  </a>
</div>

<!-- <a href="{{ route('pakan.create') }}" class="btn btn-primary mb-3">+ Tambah Data Pakan</a> -->

<table class="table table-bordered">
  <thead>
    <tr>
      <th>No</th>
      <th>Tanggal Masuk</th>
      <th>Jumlah Pakan (bal)</th>
      <th>Harga per Bal (Rp)</th>
      <!-- <th>Stok (bal)</th> -->
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse($pakans as $index => $pakan)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $pakan->tanggal_pakan_masuk }}</td>
        <td>{{ $pakan->jumlah_pakan }}</td>
        <td>{{ number_format($pakan->harga_per_bal, 0, ',', '.') }}</td>
        <!-- <td>{{ $pakan->stok }}</td> -->
        <td>
          <a href="{{ route('pakan.edit', $pakan->id_pakan) }}" class="btn btn-sm btn-primary">Edit</a>
          <form action="{{ route('pakan.destroy', $pakan->id_pakan) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button type="submit" onclick="return confirm('Hapus data ini?')" class="btn btn-sm btn-danger">Hapus</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="6" class="text-center">Belum ada data pakan</td></tr>
    @endforelse
  </tbody>
</table>

<div class="mt-3">
  <h5>Total Stok Keseluruhan: <strong>{{ $totalStok }}</strong> bal</h5>
</div>

{{ $pakans->links() }}
@endsection
