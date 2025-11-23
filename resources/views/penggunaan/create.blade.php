@extends('layouts.app')

@section('title', 'Tambah Penggunaan Pakan')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0">Tambah Penggunaan Pakan</h3>
    <a href="{{ route('penggunaan.index') }}" class="btn btn-secondary">Kembali</a>
  </div>

  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <div class="card shadow-sm">
    <div class="card-body">
      <div class="mb-3">
        <div class="alert alert-info mb-3">
          💡 Total stok pakan tersedia: <strong>{{ number_format($totalStok) }}</strong> bal
        </div>
      </div>

      <form action="{{ route('penggunaan.store') }}" method="post">
        @csrf

        <div class="mb-3">
          <label for="id_kolam" class="form-label">Kolam <span class="text-danger">*</span></label>
          <select name="id_kolam" id="id_kolam" class="form-select @error('id_kolam') is-invalid @enderror" required>
            <option value="">-- Pilih Kolam --</option>
            @foreach($kolams as $kolam)
              <option value="{{ $kolam->id_kolam }}" {{ old('id_kolam') == $kolam->id_kolam ? 'selected' : '' }}>
                {{ $kolam->nama_kolam ?? 'Kolam ' . $kolam->no_kolam }}
              </option>
            @endforeach
          </select>
          @error('id_kolam') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="tanggal" class="form-label">Tanggal Penggunaan <span class="text-danger">*</span></label>
          <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror"
                 value="{{ old('tanggal', \Carbon\Carbon::now()->format('Y-m-d')) }}" required>
          @error('tanggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="jumlah_pakan" class="form-label">Jumlah Digunakan (bal) <span class="text-danger">*</span></label>
          <input type="number" name="jumlah_pakan" id="jumlah_pakan"
                 class="form-control @error('jumlah_pakan') is-invalid @enderror"
                 min="1" max="{{ $totalStok }}" value="{{ old('jumlah_pakan', 1) }}" required>
          <div class="form-text">Maks: {{ $totalStok }} bal (total stok keseluruhan)</div>
          @error('jumlah_pakan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="keterangan" class="form-label">Keterangan</label>
          <textarea name="keterangan" id="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
        </div>

        <div class="d-flex justify-content-end gap-2">
          <a href="{{ route('penggunaan.index') }}" class="btn btn-outline-secondary">Batal</a>
          <button type="submit" class="btn btn-success">Simpan Penggunaan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
