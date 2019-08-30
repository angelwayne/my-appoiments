<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Specialty;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{

    public function create()
    {
        //
        $specialties = Specialty::all();
        return view('appointments.create',compact('specialties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data= $request->only([
            'description',
            'specialty_id',
            'doctor_id',
            'patient_id',
            'schedule_date',
            'schedule_time',
            'type'
        ]);
        Appointment::crete($data);

        $notification='La cita ha sido registrad Exitosamente';
        return bakc()->with(compact('notifiaction'));
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
