<?php

namespace App\Http\Controllers\Admin;

use App\Appointment;
use DB;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChartController extends Controller
{
    //
    public function appointmentsLine()
    {
        $monthlyCounts=Appointment::select(
                DB::raw('MONTH(created_at) as  month'),
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
        return view('charts.doctorsColum');
    }

    public function doctorJson()
    {
        $data=[];
         $data['categories']=User::doctors()->pluck('name');

         $series=[];
         $series1 = 1; //Atendidas
         $series2 = 2; //Canceladas
        $series[]=$series1;
        $series[]=$series2;
        $data['series']=$series;

        return $data; // {categories: ['A','B'],series:[1,2]}

    }
}
