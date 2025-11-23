@extends('layouts.app')

@section('content')
<h3>Tambah Data Kolam</h3>
<form action="{{ route('kolam.store') }}" method="post">
  @csrf
  <div class="mb-3">
    <label>No Kolam</label>
    <input type="text" name="no_kolam" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Tanggal Tanam</label>
    <input type="date" name="tanggal_tanam" class="form-control">
  </div>
  <div class="mb-3">
    <label>Jumlah Ikan (Kg)</label>
    <input type="number" name="jumlah_ikan" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Ukuran Ikan</label>
    <input type="text" name="ukuran_ikan" class="form-control">
  </div>
  <!-- <div class="mb-3">
    <label>Jumlah Pakan Dalam 1 Bulan</label>
    <input type="number" name="jumlah_pakan_dalam_1_bulan" class="form-control">
  </div> -->
  <div class="mb-3">
    <label>harga /kg : </label>
    <input type="text" name="harga_kg" class="form-control">
  </div>
  <button class="btn btn-primary">Simpan</button>
  <a href="{{ route('kolam.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
