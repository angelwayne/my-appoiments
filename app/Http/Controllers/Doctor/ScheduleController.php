<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\WorkDay;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $status=$request->input('status') ?: [];
        $morning_start=$request->input('morning_start');
        $morning_end=$request->input('morning_end');
        $afternoon_start=$request->input('afternoon_start');
        $afternoon_end=$request->input('afternoon_end');

        $errors=[];

        for ($i=0; $i < 7; $i++) {
            # code...
            if($morning_start[$i] > $morning_end[$i]){
            $errors[]="Las horas del turno mañana son inconsistentes para el dia ".$this->days[$i];
            }
            if($afternoon_start[$i] > $afternoon_end[$i]){
            $errors[]="Las horas del turno vespertino son inconsistentes para el dia ".$this->days[$i];
            }

            WorkDay::updateOrCreate(
                [
                'day'=>$i,
                'user_id'=>auth()->id(),

                ], [
                'status'=>in_array($i,$status),

                'morning_start'=>$morning_start[$i],
                'morning_end'=>$morning_end[$i],

                'afternoon_start'=> $afternoon_start[$i],
                'afternoon_end'=> $afternoon_end[$i],

                ]);
        }
        if(count($errors) >0 )
            return back()->with(compact('errors'));


        $notification='Los cambios se han gauarado corrrectamente. ';
        return back()->with(compact('notification'));

    }


    private $days=[
        'Lunes','Martes','Miercoles',
        'Jueves','Viernes','Sabado','Domingo'
    ];
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

        $WorkDays=WorkDay::where('user_id',auth()->id())->get();


        if(count($WorkDays) > 0) {
                $WorkDays->map(function ($workDay) {
                $workDay->morning_start= (new Carbon($workDay->morning_start))->format('g:i A');
                $workDay->morning_end= (new Carbon( $workDay->morning_end))->format('g:i A');
                $workDay->afternoon_start= (new Carbon( $workDay->afternoon_start))->format('g:i A');
                $workDay->afternoon_end= (new Carbon( $workDay->afternoon_end))->format('g:i A');
                return $workDay;
            });
        } else {
            $WorkDays = collect();
            for($i= 0;$i<7;$i++)
            $WorkDays->push(new WorkDay());
        }

      
        // dd($WorkDays->toArray());
        $days= $this->days;
        return view ('schedule',compact('WorkDays','days'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
