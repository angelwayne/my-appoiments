<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\CancelAppointment;
use App\Specialty;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Interfaces\ScheduleServiceInterface;
use Validator;

class AppointmentController extends Controller
{
    public function index()
    {
        //patiente =>
        //docotor =>
        // admin => all()

        $role=auth()->user()->role;

        if ($role == 'admin') {
            $pendingAppointments=Appointment::where('status','Reservada')
            ->paginate(10);
            $confirmedAppointments=Appointment::where('status','Confirmada')
            ->paginate(10);
            $oldAppointments=Appointment::whereIn('status',['Atendida','Cancelada'])
            ->paginate(10);
        }elseif($role == 'doctor')
        {
            $pendingAppointments=Appointment::where('status','Reservada')
            ->where('doctor_id',auth()->id())
            ->paginate(10);
            $confirmedAppointments=Appointment::where('status','Confirmada')
                ->where('doctor_id',auth()->id())
                ->paginate(10);
            $oldAppointments=Appointment::whereIn('status',['Atendida','Cancelada'])
            ->where('doctor_id',auth()->id())
            ->paginate(10);

        }elseif($role == 'patinet')
        {
            $pendingAppointments=Appointment::where('status','Reservada')
            ->where('patient_id',auth()->id())
            ->paginate(10);
            $confirmedAppointments=Appointment::where('status','Confirmada')
                ->where('patient_id',auth()->id())
                ->paginate(10);
            $oldAppointments=Appointment::whereIn('status',['Atendida','Cancelada'])
            ->where('patient_id',auth()->id())
            ->paginate(10);

        }


       return view ('appointments.index',
                compact(
                    'pendingAppointments','confirmedAppointments','oldAppointments',
                    'role'
                ));
    }

    public function show(Appointment $appointment)
    {
        $role = auth()->user()->role;
        return view('appointments.show', compact('appointment','role'));
    }

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
    public function store(Request $request, ScheduleServiceInterface $Scheduleservice)
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

        $validator=Validator::make($request->all(), $rules, $messages);

        $validator->after(function ($validator) use ($request,$Scheduleservice) {
            $date= $request->input('schedule_date');
            $doctorId= $request->input('doctor_id');
            $schedule_time= $request->input('schedule_time');
            if($date && $doctorId && $schedule_time )
            {
                $start= new Carbon($schedule_time);
            } else {
                return;
            }

            if (!$Scheduleservice->isAvilableInterval($date,$doctorId,$start)) {
                $validator->errors()
                ->add('Avilable_TIme', 'La hora releccionad ya se encuentra reservada por otro paciente');
            }
        });

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        }

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

    public function showCancelForm(Appointment $appointment)
    {

        if ($appointment->status ==='Confirmada') {
            # code...
            $role=auth()->user()->role;
            return view('appointments.cancel', compact('appointment','role'));
        }
        return redirect('/appointments');

    }
    public function cancel(Appointment $appointment,  Request $request)
    {
        if ($request->has('justification')){
            $cancellation = new CancelAppointment();
            $cancellation->justification = $request->input('justification');
            $cancellation->cancelled_by= auth()->id();
            $appointment->cancellation()->save($cancellation);

        }
        $appointment->status ='Cancelada';
        $appointment->save();

        $notification='La cita ha sido cancelada corectamente';
                return redirect('/appointments')->with(compact('notification'));
    }


    public function confirm(Appointment $appointment)
    {
        //
        $appointment->status ='Confirmada';
        $appointment->save();

        $notification='La cita ha sido confirmada corectamente';
                return redirect('/appointments')->with(compact('notification'));
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
