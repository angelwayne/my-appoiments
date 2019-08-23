<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\WorkDay;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    //
    public function hours(Request $request)
    {
        $rules=[
            'date'=> 'required|date_format:"Y-m-d"',
            'doctor_Id'=> 'required|exists:users,id'
        ];
       $this->validate($request,$rules);

        $date = $request->input('date'); 
        $dateCarbon = new Carbon($date);

        // dayOfWeek 
        //from Carbon 0 (sunday) - 6 (saturday)
        // WorkDay: 0 (Monday) - 6 (sundat)
        $i=$dateCarbon->dayOfWeek;
        $day= ($i==0 ? 6 : $i-1);
        
        $doctorId = $request->input('doctor_Id'); 

        $workDays = WorkDay::where('status',true) 
        ->where('day',$day)
        ->where('user_id',$doctorId)->get();

        dd($workDays);

          /*
            $table->time('morning_start');
            $table->time('morning_end');
            $table->time('afternoon_start');
            $table->time('afternoon_end');
            $table->unsignedInteger('user_id'); */
    }
}
