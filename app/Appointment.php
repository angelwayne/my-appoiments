<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $filable =[
        'description',
        'specialty_id',
        'doctor_id',
        'patient_id',
        'schedule_date',
        'schedule_time',
        'type'
    ];
}
