<?php

namespace App\Http\Controllers\Maid;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\MaidTimeSlots\MaidTimeSlotCreateRequest;
use App\Http\Requests\MaidTimeSlots\MaidTimeSlotEditRequest;
use App\Jobs\SendBookingRequestEmailJob;
use App\Mail\SendBookingRequestEmail;
use Illuminate\Http\Request;
use App\Models\MaidTimeSlot;
use App\Models\BookingRequest;
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

            $SaveTimeSlot = array();
            $TimeSlots = $request->time_slot_id;
            for($i=0; $i<count($request->time_slot_id);$i++)
            {
                $CheckExistingTimeSlot = MaidTimeSlot::CheckExistingTimeSlot(Carbon::parse($request->date)->format('Y-m-d'),$TimeSlots[$i]);

                if($CheckExistingTimeSlot==0)
                {
                    $MaidTimeSlot = new MaidTimeSlot();
                    $MaidTimeSlot->maid_id = Auth::User()->id;
                    $MaidTimeSlot->date = Carbon::parse($request->date)->format('Y-m-d');
                    $MaidTimeSlot->time_slot_id = $TimeSlots[$i];
                    $MaidTimeSlot->status = $request->status;
                    $SaveTimeSlot[]= $MaidTimeSlot->save();
                }
            }

            if(count($SaveTimeSlot)>0)
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
        try {
                $BookingRequests = BookingRequest::with('maid_time_slot.timeSlot')->where('maid_time_slot_id',$id)->get();

                return view('backend.schedule.booking_requests',['booking_requests'=>$BookingRequests]);
                
            } catch (ModelNotFoundException $exception) {
                session()->flash('error', 'No data found of this booking request');
                return redirect()->route('schedules.index');
            }
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

            $CheckExistingTimeSlot = MaidTimeSlot::CheckExistingTimeSlot(Carbon::parse($request->date)->format('Y-m-d'),$request->time_slot_id,$id);

                if($CheckExistingTimeSlot==0)
                {
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

                } else {
                    session()->flash('error', 'Sorry! this time slot Data is already existing with selected date.');
                        return redirect()->route('schedules.index');
                }
        } catch (\Illuminate\Database\QueryException $exception) {

            return back()->withError($exception->errorInfo)->withInput();
        }
    }

    public function AjaxBookingRequest()
    {
        if (request()->ajax()) {

            $BookingRequests = BookingRequest::where(['id'=>request()->input('request_id'),'maid_id'=>Auth::User()->id])->first();

            $CheckBookingStatus = BookingRequest::where('booking_id',$BookingRequests->booking_id)->where('status',2)->count();

            if($CheckBookingStatus==0)
            {
                $BookingRequests->arrive_date = request() ->input('arrive_date');
                $BookingRequests->arrive_time = request()->input('arrive_time');
                $BookingRequests->status = request()->input('status');

                if($BookingRequests->save())
                {
                    if(request()->input('status')==2)
                    {
                        // Send Alert to user
                        dispatch_now(new SendBookingRequestEmailJob($BookingRequests->booking_details->customer,$BookingRequests,'sent_to_customer'));

                        // Delete other requests who have sent to another maids
                        $DeleteOtherBookingRequests = BookingRequest::where('id','<>',$BookingRequests->id)->where(['booking_id'=>$BookingRequests->booking_id,'status'=>1])->delete();
                    }

                    return response()->json(['status'=>true,'message'=>'Booking request has been '.request()->input('type')]);

                } else {

                    return response()->json(['status'=>false,'message'=>'Sorry! Booking request has not been updated']);

                }
            } else {

                return response()->json(['status'=>false,'message'=>'Sorry! This booking id request has already accepted']);
            }
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
