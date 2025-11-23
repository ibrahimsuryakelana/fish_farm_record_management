<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pakan;

class PakanController extends Controller
{
    public function index()
    {
        $pakans = Pakan::orderBy('tanggal_pakan_masuk','desc')->paginate(15);
        $totalStok = Pakan::getTotalStok(); // total dari semua jumlah_pakan
        return view('pakan.index', compact('pakans', 'totalStok'));
    }

    public function create()
    {
        return view('pakan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal_pakan_masuk' => 'required|date',
            'jumlah_pakan' => 'required|integer|min:0',
            'harga_per_bal' => 'required|numeric|min:0',
        ]);

        // stok awal = jumlah pakan yang masuk
        $data['stok'] = $data['jumlah_pakan'];

        // simpan data
        Pakan::create($data);

        // update total stok
        $this->updateTotalStok();

        return redirect()->route('pakan.index')->with('success','Data pakan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pakan = Pakan::findOrFail($id);
        return view('pakan.edit', compact('pakan'));
    }

    public function update(Request $request, $id)
    {
        $pakan = Pakan::findOrFail($id);

        $data = $request->validate([
            'tanggal_pakan_masuk' => 'required|date',
            'jumlah_pakan' => 'required|integer|min:0',
            'harga_per_bal' => 'required|numeric|min:0',
        ]);

        // stok otomatis mengikuti jumlah
        $data['stok'] = $data['jumlah_pakan'];

        $pakan->update($data);

        // update total stok
        $this->updateTotalStok();

        return redirect()->route('pakan.index')->with('success','Data pakan berhasil diupdate');
    }

    public function destroy($id)
    {
        $pakan = Pakan::findOrFail($id);
        $pakan->delete();

        // update total stok
        $this->updateTotalStok();

        return redirect()->route('pakan.index')->with('success','Data pakan berhasil dihapus');
    }

    private function updateTotalStok()
    {
        $total = Pakan::sum('jumlah_pakan');
        // update semua stok jadi total baru
        Pakan::query()->update(['stok' => $total]);
    }
}
