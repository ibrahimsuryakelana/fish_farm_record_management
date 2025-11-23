<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KolamIkan extends Model
{
    protected $table = 'kolam_ikans';
    protected $primaryKey = 'id_kolam';
    protected $guarded = [];

    public function penggunaan()
    {
        return $this->hasMany(PenggunaanPakan::class, 'id_kolam', 'id_kolam');
    }

    public function panens()
    {
        return $this->hasMany(Panen::class, 'id_kolam', 'id_kolam');
    }
}
