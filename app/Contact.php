<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = false;

    protected $table = 'contact';
	
	public function district()
    {
        return $this->belongsTo('App\District' , 'mahuyen', 'mahuyen');
    }
}
