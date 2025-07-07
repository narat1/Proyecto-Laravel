<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function volunteers()
    {
        return $this->belongsToMany(User::class, 'volunteers');
    }
}
