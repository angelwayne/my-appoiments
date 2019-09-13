<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class CancelAppointment extends Model
{
    //
    public function cancelled_by() //cancel_by_id
    {
        return $this->belongsTo(User::class);
    }
}
