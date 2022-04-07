<?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace App\Service;

use App\Repositories\TimeSlotsRepository;
use App\Models\TimeSlot;
use App\Models\MaidTimeSlot;
use Illuminate\Support\Carbon;

class TimeSlotsClass implements TimeSlotsRepository
{
    // all list
    public function listAll()
    {
            return TimeSlot::paginate(10);
    }

    public function maidTimeSlots($date)
    {
        $Date = Carbon::parse($date);
        $Day1 = $Date->addDays(0)->format('Y-m-d');
        $Day2 = $Date->addDays(1)->format('Y-m-d');
        $Day3 = $Date->addDays(2)->format('Y-m-d');
        $Day4 = $Date->addDays(3)->format('Y-m-d');
        $Day5 = $Date->addDays(4)->format('Y-m-d');

        $NextDates = array('day1'=>$Day1,'day2'=>$Day2,'day3'=>$Day3,'day4'=>$Day4,'day5'=>$Day5);

        $NextDaysSlots = array();
        foreach($NextDates as $key=>$value)
        {
            $MaidTimeSlot =  MaidTimeSlot::with('timeSlot')->where('date',$value)->get();
            $NextDaysSlots[$value][] = $MaidTimeSlot;
        }

        return $NextDaysSlots;
    }


    public function Details($id)
    {
        return TimeSlot::findOrfail($id);
    }

    public function getAllTimeSlot() {
        return TimeSlot::get();
    }
}
