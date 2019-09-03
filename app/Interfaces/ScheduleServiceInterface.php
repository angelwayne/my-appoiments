<?php
namespace  App\Interfaces;

interface ScheduleServiceInterface
{
    public function getAvilableIntervals($date,$doctorId);
}
?>
