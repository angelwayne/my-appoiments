<?php


namespace App;
use Carbon\Carbon;
use App\CancelAppointment;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable =[
        'description',
        'specialty_id',
        'doctor_id',
        'patient_id',
        'schedule_date',
        'schedule_time',
        'type'
    ];



    // N $appointmente->speciatly 1
    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    //N $appointmente->doctor 1
    public function doctor()
    {
        return $this->belongsTo(User::class);
    }

    //N $appointment->patient 1
    public function patient()
    {
        return $this->belongsTo(User::class);
    }

    public function cancellation()
    {
        return $this->hasOne(CancelAppointment::class);
    }

    // accesor
    public function getScheduleTime12Attribute ()
    {
        return (new Carbon($this->schedule_time))
        ->format('g:i A');
    }
}
