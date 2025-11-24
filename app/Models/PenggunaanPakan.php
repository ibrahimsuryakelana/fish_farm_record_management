<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaanPakan extends Model
{
    use HasFactory;

    protected $table = 'penggunaan_pakans';
    protected $primaryKey = 'id_penggunaan';
    protected $fillable = [
        'id_kolam',
        'id_pakan',
        'tanggal',
        'jumlah_pakan',
        'keterangan',
    ];

    // Relation ke kolam
    public function kolam()
    {
        return $this->belongsTo(KolamIkan::class, 'id_kolam', 'id_kolam');
    }

    // Relation ke pakan
    public function pakan()
    {
        return $this->belongsTo(Pakan::class, 'id_pakan', 'id_pakan');
    }
}
