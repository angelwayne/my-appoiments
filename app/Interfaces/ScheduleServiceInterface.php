<?php
namespace  App\Interfaces;

use Carbon\Carbon;

interface ScheduleServiceInterface
{
    public function getAvilableIntervals($date,$doctorId);

    public function isAvilableInterval($date,$doctorId, Carbon $start);
}
?>
