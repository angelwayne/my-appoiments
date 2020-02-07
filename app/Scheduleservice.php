<?php
namespace App\Services;

use App\Appointment;
use App\WorkDay;
use App\Interfaces\ScheduleServiceInterface;
use Carbon\Carbon;

class ScheduleService implements ScheduleServiceInterface
{
    public function isAvilableInterval ($date, $doctorId, Carbon $start)
    {
        $exists=Appointment::where('doctor_id',$doctorId)
            ->where('schedule_date',$date)
            ->where('schedule_time',$start->format('H:i:s'))
            ->exists();

        return !$exists;
    }

    private function getDayFromDate($date)
    {
        $dateCarbon = new Carbon($date);

        // dayOfWeek
        //from Carbon 0 (sunday) - 6 (saturday)
        // WorkDay: 0 (Monday) - 6 (sunday)
        $i=$dateCarbon->dayOfWeek;
        $day= ($i==0 ? 6 : $i-1);
        return $day;
    }

    public function getAvilableIntervals($date, $doctorId)
    {
        $workDays = WorkDay::where('status',true)
        ->where('day',$this->getDayFromDate($date))
        ->where('user_id',$doctorId)
        ->first([
            'morning_start','morning_end',
            'afternoon_start','afternoon_end'
            ]);

        if ($workDays) {
            $morningIntervals=$this->getIntervls(
                                $workDays->morning_start,
                                $workDays->morning_end,
                            $date,$doctorId);

            $afternoonIntervals=$this->getIntervls(
                                $workDays->afternoon_start,
                                $workDays->afternoon_end,
                                $date,$doctorId);
        }else{
            $morningIntervals = [];
            $afternoonIntervals =[];
        }
        
            // http://my-appoiments.test.com/schedule/hours?date=2019-08-22&doctor_Id=3

            $data =[];
            $data['morning']=$morningIntervals;
            $data['afternoon']=$afternoonIntervals;

            return $data;
    }

    private function getIntervls($start ,$end, $date, $doctorId)
    {

        $start = new Carbon ($start);
        $end = new Carbon ($end);


        $intervals=[];
        while ($start < $end) {
            $interval=[];


            $interval['start'] = $start->format('g:i A');

            $avilable=$this->isAvilableInterval($date,$doctorId,$start);

            $start->addMinutes(30);
            $interval['end'] = $start->format('g:i A');

            //dd($exists);
                if($avilable){
                    $intervals[]= $interval;
                }
            }
        return $intervals;
    }
}
?>
