<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AircraftType extends Model
{
    protected $fillable = [
        'manufacturer',
        'type',
        'left_engine_type_id',
        'right_engine_type_id',
        'front_engine_type_id',
        'rear_engine_type_id',
        'middle_engine_type_id',
    ];

    public function aircrafts()
    {
    	return $this->hasMany(Aircraft::class);
    }

    public function leftEngineType()
    {
        return $this->belongsTo(EngineType::class);
    }

    public function rightEngineType()
    {
        return $this->belongsTo(EngineType::class);
    }

    public function frontEngineType()
    {
        return $this->belongsTo(EngineType::class);
    }

    public function rearEngineType()
    {
        return $this->belongsTo(EngineType::class);
    }

    public function middleEngineType()
    {
        return $this->belongsTo(EngineType::class);
    }
}
