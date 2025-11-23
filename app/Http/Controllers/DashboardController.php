<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KolamIkan;
use App\Models\Pakan;
use App\Models\Panen;
use App\Models\PenggunaanPakan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKolam = KolamIkan::count();
        $totalPakanEntries = Pakan::count();
        $totalStok = Pakan::sum('stok');
        $totalPanenKg = Panen::sum('hasil_panen_kg');
        $totalKeuntungan = Panen::sum('keuntungan');

        return view('dashboard.index', compact('totalKolam','totalPakanEntries','totalStok','totalPanenKg','totalKeuntungan'));
    }
}
