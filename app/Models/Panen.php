<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    protected $table = 'panens';
    protected $primaryKey = 'id_panen';
    protected $guarded = [];

    public function kolam()
    {
        return $this->belongsTo(KolamIkan::class, 'id_kolam', 'id_kolam');
    }
}
