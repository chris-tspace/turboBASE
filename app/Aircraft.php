<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model
{
    protected $fillable = [
        'aircraft_type_id',
        'serial_number',
        'manufacturer_code',
        'engine1_id',
        'engine2_id',
        'engine3_id',
        'engine4_id',
    ];

    public function engines()
    {
    	return $this->hasMany(Engine::class);
    }

    public function aircraftType()
    {
    	return $this->belongsTo(AircraftType::class);
    }
}
