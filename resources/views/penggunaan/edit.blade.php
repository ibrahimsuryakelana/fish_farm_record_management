@extends('layouts.app')

@section('title', 'Edit Penggunaan Pakan')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">✏️ Edit Penggunaan Pakan</h3>
        <a href="{{ route('penggunaan.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('penggunaan.update', $penggunaan->id_penggunaan ?? $penggunaan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    {{-- Kolam --}}
                    <div class="col-md-6">
                        <label for="id_kolam" class="form-label fw-semibold">Kolam <span class="text-danger">*</span></label>
                        <select name="id_kolam" id="id_kolam" class="form-select @error('id_kolam') is-invalid @enderror" required>
                            <option value="">-- Pilih Kolam --</option>
                            @foreach($kolams as $kolam)
                                <option value="{{ $kolam->id_kolam }}"
                                    {{ old('id_kolam', $penggunaan->id_kolam) == $kolam->id_kolam ? 'selected' : '' }}>
                                    {{ $kolam->nama_kolam ?? 'Kolam '.$kolam->id_kolam }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kolam')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Pakan --}}
                    <div class="col-md-6">
                        <label for="id_pakan" class="form-label fw-semibold">Pakan</label>
                        <select name="id_pakan" id="id_pakan" class="form-select @error('id_pakan') is-invalid @enderror">
                            <option value="">-- Pilih Pakan (opsional) --</option>
                            @foreach($pakans as $pakan)
                                <option value="{{ $pakan->id_pakan }}"
                                    {{ old('id_pakan', $penggunaan->id_pakan) == $pakan->id_pakan ? 'selected' : '' }}>
                                    {{ $pakan->nama_pakan ?? 'Pakan '.$pakan->id_pakan }} (stok: {{ $pakan->stok }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_pakan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal --}}
                    <div class="col-md-4">
                        <label for="tanggal" class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" id="tanggal"
                            value="{{ old('tanggal', \Carbon\Carbon::parse($penggunaan->tanggal)->format('Y-m-d')) }}"
                            class="form-control @error('tanggal') is-invalid @enderror" required>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jumlah Pakan --}}
                    <div class="col-md-4">
                        <label for="jumlah_pakan" class="form-label fw-semibold">Jumlah Pakan (bal) <span class="text-danger">*</span></label>
                        <input type="number" name="jumlah_pakan" id="jumlah_pakan"
                            value="{{ old('jumlah_pakan', $penggunaan->jumlah_pakan) }}"
                            min="1" class="form-control @error('jumlah_pakan') is-invalid @enderror" required>
                        @error('jumlah_pakan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Keterangan --}}
                    <div class="col-md-4">
                        <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan"
                            value="{{ old('keterangan', $penggunaan->keterangan) }}"
                            class="form-control @error('keterangan') is-invalid @enderror">
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('penggunaan.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
