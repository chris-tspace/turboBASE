<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Engine extends Model
{
    protected $fillable = [
        'engine_type_id', 
        'serial_number', 
        'ident',
        'aircraf_id',
        'aircraft_position',
    ];

    public function engineType()
    {
    	return $this->belongsTo(EngineType::class);
    }

    public function aircraft()
    {
        return $this->belongsTo(Aircraft::class);
    }
}
