<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
    protected $table = 'emp_terminal'; // <== IMPORTANTE
    protected $primaryKey = 'ter_id';
    public $timestamps = false;

    public function ubigeo()
    {
        return $this->belongsTo(Ubigeo::class, 'ter_ubigeo', 'ubi_id');
    }
}
