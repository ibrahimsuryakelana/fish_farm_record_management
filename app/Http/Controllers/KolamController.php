<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KolamIkan;

class KolamController extends Controller
{
    public function index()
    {
        $kolams = KolamIkan::orderBy('no_kolam')->paginate(15);
        return view('kolam.index', compact('kolams'));
    }

    public function create()
    {
        return view('kolam.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal_tanam' => 'nullable|date',
            'no_kolam' => 'required|string',
            'jumlah_ikan' => 'required|integer|min:0',
            'ukuran_ikan' => 'nullable|string',
            'jumlah_pakan_dalam_1_bulan' => 'nullable|integer|min:0',
            'harga_kg' => 'nullable|integer',
        ]);

        KolamIkan::create($data);

        return redirect()->route('kolam.index')->with('success','Kolam berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kolam = KolamIkan::findOrFail($id);
        return view('kolam.edit', compact('kolam'));
    }

    public function update(Request $request, $id)
    {
        $kolam = KolamIkan::findOrFail($id);
        $data = $request->validate([
            'tanggal_tanam' => 'nullable|date',
            'no_kolam' => 'required|string',
            'jumlah_ikan' => 'required|integer|min:0',
            'ukuran_ikan' => 'nullable|string',
            'jumlah_pakan_dalam_1_bulan' => 'nullable|integer|min:0',
            'harga_kg' => 'nullable|integer',
        ]);
        $kolam->update($data);
        return redirect()->route('kolam.index')->with('success','Kolam diupdate');
    }

    public function destroy($id)
    {
        KolamIkan::findOrFail($id)->delete();
        return redirect()->route('kolam.index')->with('success','Kolam dihapus');
    }

    public function getTotalPakan($id)
    {
        $kolam = KolamIkan::find($id);
        if ($kolam) {
            return response()->json([
                'total_pakan' => $kolam->jumlah_pakan_dalam_1_bulan
            ]);
        } else {
            return response()->json(['error' => 'Kolam tidak ditemukan'], 404);
        }
    }

    public function getModalAwal($id)
    {
        $kolam = KolamIkan::find($id);
        if (!$kolam) {
            return response()->json(['error' => 'Kolam tidak ditemukan'], 404);
        }

        // Ambil harga_per_bal dari tabel pakans (misalnya 1 jenis pakan dipakai)
        $pakan = \App\Models\Pakan::first(); // kalau nanti ada relasi, bisa disesuaikan

        $harga_per_bal = $pakan ? $pakan->harga_per_bal : 0;
        $jumlah_pakan = $kolam->jumlah_pakan_dalam_1_bulan ?? 0;
        $harga_kg = $kolam->harga_kg ?? 0;
        $jumlah_ikan = $kolam->jumlah_ikan ?? 0;

        $total_modal = ($jumlah_pakan * $harga_per_bal) + ($jumlah_ikan * $harga_kg);

        return response()->json([
            'total_modal' => $total_modal,
            'detail' => [
                'jumlah_pakan' => $jumlah_pakan,
                'harga_per_bal' => $harga_per_bal,
                'jumlah_ikan' => $jumlah_ikan,
                'harga_kg' => $harga_kg
            ]
        ]);
    }

}
