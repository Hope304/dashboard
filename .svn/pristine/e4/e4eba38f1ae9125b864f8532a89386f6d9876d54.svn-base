<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class verify_fire_point extends Model
{
    public $timestamps = false;
    protected $table = 'verify_fire_point';

    public function hotspot()
    {
        return $this->belongsTo('App\Hotspot', 'id_diemchay', 'id');
    }
}
