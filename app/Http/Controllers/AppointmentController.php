<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Specialty;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Interfaces\ScheduleServiceInterface;

class AppointmentController extends Controller
{

    public function create(ScheduleServiceInterface $Scheduleservice)
    {
        //
        $specialties = Specialty::all();

        $specialtyId=old('specialty_id');
        if($specialtyId){
            $specialty =Specialty::find($specialtyId);
            $doctors=$specialty->users;
        }else{
            $doctors=collect();
        }

        $scheduleDate = old('schedule_date');
        $doctorId= old('doctor_id');
        if($scheduleDate && $doctorId){
            $intervals= $Scheduleservice->getAvilableIntervals($scheduleDate,$doctorId);;
        }else{
            $intervals=null;
        }


        return view('appointments.create',compact('specialties','doctors','intervals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =[
            'description'=> 'required',
            'specialty_id'=>'exists:specialties,id',
            'doctor_id'=>'exists:users,id',
            'schedule_time'=>'required'
        ];
        $messages=[
            'schedule_time.required'=>'Por favor seleccione una hora valida
            para su cita'
        ];

        $this->validate($request, $rules, $messages);

        $data= $request->only([
            'description',
            'specialty_id',
            'doctor_id',
            'schedule_date',
            'schedule_time',
            'type'
        ]);
        $data['patient_id']=auth()->id();

        // right time format
        $carbonTime=Carbon::createFromFormat('g:i A',$data['schedule_time']);
        $data['schedule_time']=$carbonTime->format('H:i:s');
        Appointment::create($data);

        $notification='La cita ha sido registrad Exitosamente';
        return back()->with(compact('notifiaction'));
        //return redirect('/appointments');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
