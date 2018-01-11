<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Engine extends Model
{
    protected $fillable = ['engine_type_id', 'serial_number', 'ident'];

    public function engineType()
    {
    	return $this->belongsTo(EngineType::class);
    }
}
