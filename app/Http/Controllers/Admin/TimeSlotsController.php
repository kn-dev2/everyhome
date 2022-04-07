<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\TimeSlots\TimeSlotCreateRequest;
use App\Http\Requests\TimeSlots\TimeSlotEditRequest;
use App\Repositories\TimeSlotsRepository;
use Illuminate\Support\Carbon;
use App\Models\TimeSlot;

class TimeSlotsController extends Controller
{
    protected $timeslotRepository;
    public $status_dropdown;

    public function __construct(TimeSlotsRepository $timeslotRepository)
    {
        $this->status_dropdown = config('global.status_dropdown');
        $this->timeslotRepository = $timeslotRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $timeslots = $this->timeslotRepository->listAll();
        return view('backend.timeslots.index',['timeslots'=>$timeslots]);
    }

    public function ajaxGetSlots()
    {
        if (request()->ajax()) {

            $date = request()->input('date');
            $timeslots = $this->timeslotRepository->getAllTimeSlot();
            $Options = '';
            for ($i=0;$i<5;$i++)
            {
                $Date = Carbon::parse($date)->addDays($i)->format('D M, d');
                $Date1 = Carbon::parse($date)->addDays($i)->format('Y-m-d');
                $Options .= '<OPTGROUP LABEL="'.$Date.'" id="'.$Date.'">'.$this->GetOptions($Date1).'</OPTGROUP>';
            }
            return response()->json([$Options]);

        }
    }

    private function GetOptions($date)
    {
        $Date    = Carbon::parse($date)->format('D');
        $holidays = ['Sat','Sun'];
        $Option = '';
        if(in_array($Date,$holidays)) {
            $Option .= '<OPTION LABEL="" value="">No data available</OPTION>';
        } else {
            $timeslots = $this->timeslotRepository->getAllTimeSlot();
            foreach ($timeslots as $SingletimeSlot)
            {
                $Option .= '<OPTION LABEL="'.$SingletimeSlot->slot.'" value="'.Carbon::parse($date)->format('m/d/Y').'#'.$SingletimeSlot->id.'#'.$SingletimeSlot->slot.'">'.$SingletimeSlot->slot.'</OPTION>';
            }
        }
        
        return $Option;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.timeslots.create',['status_dropdown'=>$this->status_dropdown]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TimeSlotCreateRequest $request)
    {
        //
        try {

            $TimeSlot = new TimeSlot();
            $TimeSlot->slot = $request->slot;
            $TimeSlot->status = $request->status;
            $SaveTimeSlot= $TimeSlot->save();

            if($SaveTimeSlot)
            {
                    session()->flash('success', 'Time slot Data is saved.');
                    return redirect()->route('timeslots.index');
            } else {
                session()->flash('error', 'Time slot Data is not saved.');
                return redirect()->route('backend.timeslots.index');
            }
        } catch (\Illuminate\Database\QueryException $exception) {

            return back()->withError($exception->errorInfo)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $timeslot = $this->timeslotRepository->Details($id);
       } catch (ModelNotFoundException $exception) {
           session()->flash('error', 'No data found of this id');
           return redirect()->route('timeslots.index');
       }
       return view('backend.timeslots.update')->with(['timeslot'=>$timeslot,'status_dropdown'=>$this->status_dropdown]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TimeSlotEditRequest $request, $id)
    {
        try {

            $TimeSlot = TimeSlot::findOrFail($id);
            $TimeSlot->slot = $request->slot;
            $TimeSlot->status = $request->status;
            $SaveTimeSlot = $TimeSlot->save();

            if ($SaveTimeSlot) 
            {
                session()->flash('success', 'Time slot has been updated.');
                return redirect()->route('timeslots.index');
  
            } else {
                session()->flash('error', 'Time slot is not updated.');
                return redirect()->route('timeslots.index');
            }
        } catch (\Illuminate\Database\QueryException $exception) {

            return back()->withError($exception->errorInfo)->withInput();
        }
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
