@extends('layouts.app')

@section('content')
<h3>Tambah Data Panen</h3>
<form action="{{ route('panen.store') }}" method="post">
  @csrf
  <div class="mb-3">
    <label>Kolam</label>
    <select name="id_kolam" id="kolamSelect" class="form-control" required>
      <option value="">-- Pilih Kolam --</option>
      @foreach($kolams as $k)
        <option value="{{ $k->id_kolam }}">{{ $k->no_kolam }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label>Tanggal Panen</label>
    <input type="date" name="tanggal_panen" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Jumlah Pakan Total (bal)</label>
    <input type="number" id="jumlahPakanTotal" name="jumlah_pakan_total" class="form-control" readonly>
  </div>

  <div class="mb-3">
    <label>Hasil Panen (Kg)</label>
    <input type="number" name="hasil_panen_kg" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Harga Jual per Kg</label>
    <input type="number" name="harga_jual_per_kg" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Total Modal (otomatis)</label>
    <input type="number" id="totalModal" name="total_modal" class="form-control" readonly>
  </div>

  <button class="btn btn-primary">Simpan</button>
  <a href="{{ route('panen.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    console.log("✅ Script create panen aktif");

    // ambil total pakan dari kolam
    function loadTotalPakan(kolamId) {
        if (!kolamId) {
            $('#jumlahPakanTotal').val('');
            return;
        }

        $.ajax({
            url: '/kolam/' + kolamId + '/total-pakan',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.total_pakan !== undefined) {
                    $('#jumlahPakanTotal').val(data.total_pakan);
                } else {
                    $('#jumlahPakanTotal').val('');
                }
            },
            error: function(xhr, status, error) {
                console.error("❌ Error total-pakan:", status, error);
                $('#jumlahPakanTotal').val('');
            }
        });
    }

    // ambil total modal dari kolam dan pakan
    function loadModalAwal(kolamId) {
        if (!kolamId) {
            $('#totalModal').val('');
            return;
        }

        $.ajax({
            url: '/kolam/' + kolamId + '/modal-awal',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log("Respons modal awal:", data);
                if (data.total_modal !== undefined) {
                    $('#totalModal').val(data.total_modal);
                } else {
                    $('#totalModal').val('');
                }
            },
            error: function(xhr, status, error) {
                console.error("❌ Error modal-awal:", status, error);
                $('#totalModal').val('');
            }
        });
    }

    // saat kolam dipilih
    $('#kolamSelect').on('change', function() {
        var kolamId = $(this).val();
        console.log("Kolam dipilih:", kolamId);
        loadTotalPakan(kolamId);
        loadModalAwal(kolamId);
    });
});
</script>
@endsection
