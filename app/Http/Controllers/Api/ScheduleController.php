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
        ->where('user_id',$doctorId)
        ->first([
            'morning_start','morning_end',
            'afternoon_start','afternoon_end'
            ]);

        if (!$workDays) {
            # code...
            return[];
        }

        $morningIntervals=$this->getIntervls(
                                $workDays->morning_start,
                                $workDays->morning_end);

        $afternoonIntervals=$this->getIntervls(
                                $workDays->afternoon_start,
                                $workDays->afternoon_end);
            // http://my-appoiments.test.com/schedule/hours?date=2019-08-22&doctor_Id=3

            $data =[];
            $data['morning']=$morningIntervals;
            $data['afternoon']=$afternoonIntervals;
            return $data;


    }

    private function getIntervls($start ,$end)
    {

        $start = new Carbon ($start);
        $end = new Carbon ($end);


        $intervals=[];
        while ($start < $end) {
            $interval=[];

            $interval['start'] = $start->format('g:i A');
            $start->addMinutes(30);
            $interval['end'] = $start->format('g:i A');

            $intervals[]= $interval;

            }
        return $intervals;
    }
}
