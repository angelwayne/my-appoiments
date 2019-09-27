<?php

namespace App\Http\Controllers\Admin;

use App\Appointment;
use DB;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ChartController extends Controller
{
    //
    public function appointmentsLine()
    {
        $monthlyCounts=Appointment::select(
                DB::raw('MONTH(schedule_date) as  month'),
                DB::raw('COUNT(1) as cantidad')
            )->groupBy('month')->get()->toArray();

        $counts =array_fill(0,12,0);
        foreach ($monthlyCounts as $monthlyCount) {
            # code...
            $index=$monthlyCount['month'];
            $counts[$index] =  $monthlyCount['cantidad'];
        }
        //dd($counts);

        return view('charts.appointmentsLine', compact('counts'));
    }

    public function doctorsColum()
    {
        $now = Carbon::now();
        $end = $now->format('Y-m-d');
        $start = $now->subMonths(3)->format('Y-m-d') ;
        return view('charts.doctorsColum',compact('start','end'));
    }

    public function doctorJson(Request $request)
    {

       $start = $request->input('start');
       $end = $request->input('end');

       $doctors =User::doctors()
       ->select('name')
        ->withCount([
            'asDoctorAppointments'=> function ($query) use  ($start, $end) {
                $query->whereBetween('schedule_date', [$start, $end]);
            },
            'attendedAppointments' => function ($query) use  ($start, $end) {
                $query->whereBetween('schedule_date', [$start, $end]);
            },
            'cancelledAppointments' => function ($query) use  ($start, $end) {
                $query->whereBetween('schedule_date', [$start, $end]);
            }
            ])
        ->orderby('attended_appointments_count','desc')
        ->take(5)
        ->get();


        $data=[];
         $data['categories']=$doctors->pluck('name');

         $series=[];
         //Atendidas
         $series1['name']='Citas Atendidas';
         $series1 ['data']= $doctors->pluck('attended_appointments_count');
         //Canceladas
         $series2['name']='Citas Canceladas';
         $series2['data']= $doctors->pluck('cancelled_appointments_count');
         //Total de Appointments
         $series3['name']='Total de Citas';
         $series3['data']= $doctors->pluck('as_doctor_appointments_count');

         $series[]=$series1;
        $series[]=$series2;
        $series[]=$series3;
        $data['series']=$series;

        return $data; // {categories: ['A','B'],series:[1,2]}

    }
}
