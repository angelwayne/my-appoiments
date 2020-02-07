<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\ScheduleServiceInterface;

use App\WorkDay;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    //
    public function hours(Request $request, ScheduleServiceInterface $Scheduleservice)
    {
        $rules=[
            'date'=> 'required|date_format:"Y-m-d"',
            'doctor_Id'=> 'required|exists:users,id'
        ];
       $request->validate($request,$rules);

        $date = $request->input('date');
        $doctorId = $request->input('doctor_Id');

        return  $Scheduleservice->getAvilableIntervals($date,$doctorId);

    }

}
