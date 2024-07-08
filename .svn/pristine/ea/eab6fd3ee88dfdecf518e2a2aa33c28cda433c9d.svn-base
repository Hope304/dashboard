<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotspot extends Model
{
    public $timestamps = false;
    protected $table = 'hotspot';

    public function commune()
    {
        return $this->belongsTo('App\Commune' , 'maxa', 'maxa');
    }

    public function verify_fire_point()
    {
        return $this->hasMany('App\verify_fire_point' , 'id_diemchay', 'id');
    }
}
