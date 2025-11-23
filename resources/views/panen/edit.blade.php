@extends('layouts.app')

@section('content')
<h3>Edit Data Panen</h3>
<form action="{{ route('panen.update', $panen->id_panen) }}" method="post">
  @csrf @method('PUT')
  <div class="mb-3">
    <label>Kolam</label>
    <select name="id_kolam" class="form-control" required>
      @foreach($kolams as $k)
        <option value="{{ $k->id_kolam }}" {{ $panen->id_kolam == $k->id_kolam ? 'selected' : '' }}>
          {{ $k->no_kolam }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="mb-3">
    <label>Tanggal Panen</label>
    <input type="date" name="tanggal_panen" value="{{ $panen->tanggal_panen }}" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Jumlah Pakan Total (bal)</label>
    <input type="number" name="jumlah_pakan_total" value="{{ $panen->jumlah_pakan_total }}" class="form-control">
  </div>
  <div class="mb-3">
    <label>Hasil Panen (Kg)</label>
    <input type="number" name="hasil_panen_kg" value="{{ $panen->hasil_panen_kg }}" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Harga Jual per Kg</label>
    <input type="number" name="harga_jual_per_kg" value="{{ $panen->harga_jual_per_kg }}" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Total Modal</label>
    <input type="number" name="total_modal" value="{{ $panen->total_modal }}" class="form-control">
  </div>
  <button class="btn btn-primary">Update</button>
  <a href="{{ route('panen.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
