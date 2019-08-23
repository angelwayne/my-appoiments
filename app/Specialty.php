<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    // specialties

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
