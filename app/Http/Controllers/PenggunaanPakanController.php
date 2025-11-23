<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenggunaanPakan;
use App\Models\KolamIkan;
use App\Models\Pakan;

class PenggunaanPakanController extends Controller
{
    public function index()
    {
        $items = PenggunaanPakan::with('kolam')->orderBy('tanggal', 'desc')->paginate(20);
        return view('penggunaan.index', compact('items'));
    }

    public function create()
    {
        $kolams = KolamIkan::all();
        // total stok dari tabel pakans (semua stok dijumlahkan)
        $totalStok = Pakan::sum('stok');

        return view('penggunaan.create', compact('kolams', 'totalStok'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_kolam' => 'required|exists:kolam_ikans,id_kolam',
            'tanggal' => 'required|date',
            'jumlah_pakan' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        // Ambil total pakan pertama (anggap total disimpan di satu record)
        $pakan = \App\Models\Pakan::first();
        if (!$pakan) {
            return back()->with('error', 'Belum ada data pakan di sistem.');
        }

        // Cek jumlah pakan cukup
        if ($pakan->jumlah_pakan < $data['jumlah_pakan']) {
            return back()->with('error', 'Jumlah pakan tidak cukup.');
        }

        // Kurangi jumlah pakan total
        $pakan->jumlah_pakan -= $data['jumlah_pakan'];
        $pakan->save();

        // Simpan ke tabel penggunaan_pakans
        \App\Models\PenggunaanPakan::create($data);

        // Tambahkan jumlah pakan ke kolam sesuai id_kolam
        $kolam = \App\Models\KolamIkan::find($data['id_kolam']);
        if ($kolam) {
            $kolam->jumlah_pakan_dalam_1_bulan += $data['jumlah_pakan'];
            $kolam->save();
        }

        return redirect()->route('penggunaan.index')->with('success', 'Penggunaan pakan berhasil disimpan.');
    }


    public function edit($id)
    {
        $penggunaan = PenggunaanPakan::findOrFail($id);
        $kolams = KolamIkan::all();
        // kirim juga pakans supaya view edit yang lama tetap jalan
        $pakans = Pakan::where('stok', '>', 0)->get();

        return view('penggunaan.edit', compact('penggunaan','kolams','pakans'));
    }

    public function update(Request $request, $id)
    {
        $penggunaan = PenggunaanPakan::findOrFail($id);
        $data = $request->validate([
            'id_kolam' => 'required|exists:kolam_ikans,id_kolam',
            'tanggal' => 'required|date',
            'jumlah_pakan' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        // Kembalikan stok total dari penggunaan sebelumnya
        $sisa = $penggunaan->jumlah_pakan;
        $pakans = Pakan::orderBy('tanggal_pakan_masuk', 'desc')->get();

        foreach ($pakans as $pakan) {
            if ($sisa <= 0) break;
            $pakan->stok += $sisa;
            $pakan->save();
            $sisa = 0;
        }

        // Kurangi stok total sesuai data baru
        $sisaBaru = $data['jumlah_pakan'];
        $pakansBaru = Pakan::orderBy('tanggal_pakan_masuk', 'asc')->get();

        foreach ($pakansBaru as $pakan) {
            if ($sisaBaru <= 0) break;

            $ambil = min($pakan->stok, $sisaBaru);
            $pakan->stok -= $ambil;
            $pakan->save();

            $sisaBaru -= $ambil;
        }

        // Update jumlah pakan di kolam
        $kolamLama = KolamIkan::find($penggunaan->id_kolam);
        $kolamLama->jumlah_pakan_dalam_1_bulan -= $penggunaan->jumlah_pakan;
        $kolamLama->save();

        $kolamBaru = KolamIkan::find($data['id_kolam']);
        $kolamBaru->jumlah_pakan_dalam_1_bulan += $data['jumlah_pakan'];
        $kolamBaru->save();

        $penggunaan->update($data);

        return redirect()->route('penggunaan.index')->with('success', 'Data penggunaan pakan berhasil diupdate dan stok total disesuaikan.');
    }

    public function destroy($id)
    {
        $item = PenggunaanPakan::findOrFail($id);

        // Kembalikan stok pakan total
        $sisa = $item->jumlah_pakan;
        $pakans = Pakan::orderBy('tanggal_pakan_masuk', 'desc')->get();

        foreach ($pakans as $pakan) {
            if ($sisa <= 0) break;
            $pakan->stok += $sisa;
            $pakan->save();
            $sisa = 0;
        }

        // Kurangi total kolam
        $kolam = KolamIkan::find($item->id_kolam);
        if ($kolam) {
            $kolam->jumlah_pakan_dalam_1_bulan -= $item->jumlah_pakan;
            $kolam->save();
        }

        $item->delete();

        return redirect()->route('penggunaan.index')->with('success', 'Data penggunaan pakan dihapus dan stok total dikembalikan.');
    }
}
