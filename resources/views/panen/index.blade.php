@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
  <h3 class="fw-bold mb-0">📊 Data Panen Ikan</h3>
  <a href="{{ route('panen.create') }}" class="btn btn-success">Tambah Panen</a>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>No</th>
      <th>Kolam</th>
      <th>Tanggal Panen</th>
      <th>Hasil Panen (Kg)</th>
      <th>Harga/Kg</th>
      <th>Total Penjualan</th>
      <th>Total Modal</th>
      <th>Keuntungan</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($panens as $p)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $p->kolam->no_kolam ?? '-' }}</td>
      <td>{{ $p->tanggal_panen }}</td>
      <td>{{ $p->hasil_panen_kg }}</td>
      <td>{{ number_format($p->harga_jual_per_kg) }}</td>
      <td>{{ number_format($p->total_penjualan) }}</td>
      <td>{{ number_format($p->total_modal) }}</td>
      <td><strong>{{ number_format($p->keuntungan) }}</strong></td>
      <td>
        <a href="{{ route('panen.edit', $p->id_panen) }}" class="btn btn-sm btn-primary">Edit</a>
        <form action="{{ route('panen.destroy', $p->id_panen) }}" method="post" style="display:inline">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $panens->links() }}
@endsection
