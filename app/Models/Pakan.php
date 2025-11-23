<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pakan extends Model
{
    protected $table = 'pakans';
    protected $primaryKey = 'id_pakan';
    protected $guarded = [];

    // Hitung total stok keseluruhan dari semua data
    public static function getTotalStok()
    {
        return self::sum('jumlah_pakan');
    }
}
