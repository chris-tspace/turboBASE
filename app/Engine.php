<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Engine extends Model
{
    protected $fillable = [
        'engine_type_id', 
        'serial_number', 
        'identification',
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

    public function positionName()
    {
        switch ($this->aircraft_position) {
            case 1:
            return 'left';

            case 2:
            return 'right';

            case 3:
            return 'front';

            case 4:
            return 'rear';

            case 5:
            return 'middle';
        }

        return '';
    }
}
