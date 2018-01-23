<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EngineType extends Model
{
    protected $fillable = [
        'family',
        'variant',
        'type',
    ];

    public function engines()
    {
    	return $this->hasMany(Engine::class);
    }

    public function leftAircraftTypes()
    {
        return $this->hasMany(AircraftType::class, 'left_engine_type_id'); 
    }

    public function rightAircraftTypes()
    {
        return $this->hasMany(AircraftType::class, 'right_engine_type_id'); 
    }

    public function frontAircraftTypes()
    {
        return $this->hasMany(AircraftType::class, 'front_engine_type_id'); 
    }

    public function rearAircraftTypes()
    {
        return $this->hasMany(AircraftType::class, 'rear_engine_type_id'); 
    }

    public function middleAircraftTypes()
    {
        return $this->hasMany(AircraftType::class, 'middle_engine_type_id'); 
    }
}
