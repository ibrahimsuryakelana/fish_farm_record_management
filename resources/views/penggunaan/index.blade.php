@extends('layouts.app')

@section('title', 'Data Penggunaan Pakan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h3 class="fw-bold mb-0">📊 Data Penggunaan Pakan</h3>
  <a href="{{ route('penggunaan.create') }}" class="btn btn-success shadow-sm">
    <i class="bi bi-plus-circle"></i> Tambah Penggunaan
  </a>
</div>

{{-- Flash message --}}
@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@elseif(session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

<div class="card shadow-sm">
  <div class="card-body p-0">
    <table class="table table-hover table-bordered mb-0">
      <thead class="table-primary text-center">
        <tr>
          <th style="width:5%">No</th>
          <th>No Kolam</th>
          <!-- <th>Pakan</th> -->
          <th>Jumlah Pakan</th>
          <th>Tanggal</th>
          <th>Keterangan</th>
          <th style="width:15%">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($items as $i)
        <tr>
          <td class="text-center">{{ $loop->iteration }}</td>
          <td>{{ $i->kolam->no_kolam ?? '-' }}</td>
          <!-- <td>{{ $i->pakan->id_pakan ?? '-' }}</td> -->
          <td class="text-end">{{ number_format($i->jumlah_pakan) }}</td>
          <td>{{ \Carbon\Carbon::parse($i->tanggal)->format('d M Y') }}</td>
          <td>{{ $i->keterangan ?? '-' }}</td>
          <td class="text-center">
            <!-- <a href="{{ route('penggunaan.edit', $i) }}" class="btn btn-sm btn-primary me-1">
              <i class="bi bi-pencil-square"></i>
            </a> -->
            <form action="{{ route('penggunaan.destroy', $i) }}" method="post" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                <i class="bi bi-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="text-center text-muted py-3">
            Tidak ada data penggunaan pakan.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3 d-flex justify-content-end">
  {{ $items->links() }}
</div>
@endsection
