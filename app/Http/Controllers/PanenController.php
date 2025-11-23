<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panen;
use App\Models\KolamIkan;

class PanenController extends Controller
{
    public function index()
    {
        $panens = Panen::with('kolam')->orderBy('tanggal_panen','desc')->paginate(20);
        return view('panen.index', compact('panens'));
    }

    public function create()
    {
        $kolams = KolamIkan::all();
        return view('panen.create', compact('kolams'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_kolam' => 'required|exists:kolam_ikans,id_kolam',
            'tanggal_panen' => 'required|date',
            'jumlah_pakan_total' => 'nullable|integer|min:0',
            'hasil_panen_kg' => 'required|integer|min:0',
            'harga_jual_per_kg' => 'required|integer|min:0',
            'total_modal' => 'nullable|integer|min:0'
        ]);

        $data['total_penjualan'] = $data['hasil_panen_kg'] * $data['harga_jual_per_kg'];
        $data['keuntungan'] = ($data['total_penjualan'] ?? 0) - ($data['total_modal'] ?? 0);

        Panen::create($data);

        return redirect()->route('panen.index')->with('success','Data panen tersimpan');
    }

    public function edit($id)
    {
        $panen = Panen::findOrFail($id);
        $kolams = KolamIkan::all();
        return view('panen.edit', compact('panen','kolams'));
    }

    public function update(Request $request, $id)
    {
        $panen = Panen::findOrFail($id);
        $data = $request->validate([
            'id_kolam' => 'required|exists:kolam_ikans,id_kolam',
            'tanggal_panen' => 'required|date',
            'jumlah_pakan_total' => 'nullable|integer|min:0',
            'hasil_panen_kg' => 'required|integer|min:0',
            'harga_jual_per_kg' => 'required|integer|min:0',
            'total_modal' => 'nullable|integer|min:0'
        ]);

        $data['total_penjualan'] = $data['hasil_panen_kg'] * $data['harga_jual_per_kg'];
        $data['keuntungan'] = ($data['total_penjualan'] ?? 0) - ($data['total_modal'] ?? 0);

        $panen->update($data);

        return redirect()->route('panen.index')->with('success','Data panen diupdate');
    }

    public function destroy($id)
    {
        Panen::findOrFail($id)->delete();
        return redirect()->route('panen.index')->with('success','Data panen dihapus');
    }
}
