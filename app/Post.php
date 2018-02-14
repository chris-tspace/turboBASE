<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'aircraft_id',
        'engine_id',
        'aircraft_position',
        'type',
        'body',
        'date',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function aircraft()
    {
    	return $this->belongsTo(Aircraft::class);
    }

    public function engine()
    {
    	return $this->belongsTo(Engine::class);
    }

    public function enginePositionName()
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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
