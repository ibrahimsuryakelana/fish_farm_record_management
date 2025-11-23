@extends('layouts.app')

@section('content')
<h3>Tambah Data Pakan</h3>
<form action="{{ route('pakan.store') }}" method="post">
  @csrf
  <div class="mb-3">
    <label>Tanggal Pakan Masuk</label>
    <input type="date" name="tanggal_pakan_masuk" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Jumlah Pakan (bal)</label>
    <input type="number" name="jumlah_pakan" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Harga per Bal (Rp)</label>
    <input type="number" name="harga_per_bal" class="form-control" required>
  </div>
  <button class="btn btn-success">Simpan</button>
  <a href="{{ route('pakan.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
