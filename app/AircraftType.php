<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AircraftType extends Model
{
    protected $fillable = [
        'type',
    ];

    public function aircrafts()
    {
    	return $this->hasMany(Aircraft::class);
    }
}
