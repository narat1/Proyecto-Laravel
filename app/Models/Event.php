<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $fillable = [
    'name',
    'image',
    'description',
    'capacity',
    'start_date',
    'end_date',
    'limit_date',
    ];

    public function volunteers()
    {
        return $this->belongsToMany(User::class, 'volunteers');
    }
}
