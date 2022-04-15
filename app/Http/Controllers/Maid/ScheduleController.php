<?php

namespace App\Http\Controllers\Maid;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\MaidTimeSlots\MaidTimeSlotCreateRequest;
use App\Http\Requests\MaidTimeSlots\MaidTimeSlotEditRequest;
use Illuminate\Http\Request;
use App\Models\MaidTimeSlot;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Auth;

class ScheduleController extends Controller
{
    public $status_dropdown;

    public function __construct()
    {
        $this->status_dropdown = config('global.status_dropdown');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $MaidTimeSlot = MaidTimeSlot::where('maid_id',Auth::User()->id)->get();
        return view('backend.schedule.index',['maid_time_slots'=>$MaidTimeSlot]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $TimeSlots = TimeSlot::where('status',1)->pluck('slot','id');

        return view('backend.schedule.create',['status_dropdown'=>$this->status_dropdown,'slots'=>$TimeSlots]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaidTimeSlotCreateRequest $request)
    {
         //
         try {

            $MaidTimeSlot = new MaidTimeSlot();
            $MaidTimeSlot->maid_id = Auth::User()->id;
            $MaidTimeSlot->date = Carbon::parse($request->date)->format('Y-m-d');
            $MaidTimeSlot->time_slot_id = $request->time_slot_id;
            $MaidTimeSlot->status = $request->status;
            $SaveTimeSlot= $MaidTimeSlot->save();

            if($SaveTimeSlot)
            {
                    session()->flash('success', 'Your schedule has been saved.');
                    return redirect()->route('schedules.index');
            } else {
                session()->flash('error', 'Time slot Data is not saved.');
                return redirect()->route('schedules.index');
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
            $MaidTimeSlot = MaidTimeSlot::findOrFail($id);
            $TimeSlots = TimeSlot::where('status',1)->pluck('slot','id');

       } catch (ModelNotFoundException $exception) {
           session()->flash('error', 'No data found of this id');
           return redirect()->route('schedules.index');
       }
       return view('backend.schedule.update')->with(['maid_time_slot'=>$MaidTimeSlot,'status_dropdown'=>$this->status_dropdown,'slots'=>$TimeSlots]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MaidTimeSlotEditRequest $request, $id)
    {
        try {

            $MaidTimeSlot = MaidTimeSlot::findOrFail($id);
            $MaidTimeSlot->date = Carbon::parse($request->date)->format('Y-m-d');
            $MaidTimeSlot->time_slot_id = $request->time_slot_id;
            $MaidTimeSlot->status = $request->status;
            $SaveTimeSlot= $MaidTimeSlot->save();

            if($SaveTimeSlot)
            {
                    session()->flash('success', 'Your schedule has been saved.');
                    return redirect()->route('schedules.index');
            } else {
                session()->flash('error', 'Time slot Data is not saved.');
                return redirect()->route('schedules.index');
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