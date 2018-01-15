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
}
