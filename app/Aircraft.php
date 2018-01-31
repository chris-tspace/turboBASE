<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model
{
    protected $fillable = [
        'aircraft_type_id',
        'serial_number',
        'manufacturer_code',
    ];

    public function engines()
    {
    	return $this->hasMany(Engine::class);
    }

    public function aircraftType()
    {
    	return $this->belongsTo(AircraftType::class);
    }

    public function name()
    {
        return $this->manufacturer_code . ' (' . $this->serial_number . ')';
    }
}
