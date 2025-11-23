@extends('layouts.app')

@section('content')
<h3>Edit Data Pakan</h3>
<form action="{{ route('pakan.update', $pakan->id_pakan) }}" method="post">
  @csrf @method('PUT')
  <div class="mb-3">
    <label>Tanggal Pakan Masuk</label>
    <input type="date" name="tanggal_pakan_masuk" value="{{ $pakan->tanggal_pakan_masuk }}" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Jumlah Pakan (bal)</label>
    <input type="number" name="jumlah_pakan" value="{{ $pakan->jumlah_pakan }}" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Harga per Bal (Rp)</label>
    <input type="number" name="harga_per_bal" value="{{ $pakan->harga_per_bal }}" class="form-control" required>
  </div>
  <button class="btn btn-primary">Update</button>
  <a href="{{ route('pakan.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
