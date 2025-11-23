@extends('layouts.app')

@section('content')
<h2>Dashboard</h2>
<div class="row">
  <div class="col-md-3">
    <div class="card p-3">
      <h5>Total Kolam</h5>
      <h3>{{ $totalKolam }}</h3>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card p-3">
      <h5>Total Pakan Entries</h5>
      <h3>{{ $totalPakanEntries }}</h3>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card p-3">
      <h5>Total Stok (bal)</h5>
      <h3>{{ $totalStok }}</h3>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card p-3">
      <h5>Total Panen (kg)</h5>
      <h3>{{ $totalPanenKg }}</h3>
    </div>
  </div>
</div>
@endsection
