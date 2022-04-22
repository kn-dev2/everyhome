<?php

namespace App\Http\Controllers\Maid;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\MaidTimeSlots\MaidTimeSlotCreateRequest;
use App\Http\Requests\MaidTimeSlots\MaidTimeSlotEditRequest;
use App\Jobs\SendBookingRequestEmailJob;
use App\Models\Booking;
use App\Models\MaidTimeSlot;
use App\Models\BookingRequest;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Auth;
use Validator;

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
        $MaidTimeSlot = MaidTimeSlot::where('maid_id', Auth::User()->id)->get();
        return view('backend.schedule.index', ['maid_time_slots' => $MaidTimeSlot]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $TimeSlots = TimeSlot::where('status', 1)->pluck('slot', 'id');

        return view('backend.schedule.create', ['status_dropdown' => $this->status_dropdown, 'slots' => $TimeSlots]);
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
            for ($i = 0; $i < count($request->time_slot_id); $i++) {
                $CheckExistingTimeSlot = MaidTimeSlot::CheckExistingTimeSlot(Carbon::parse($request->date)->format('Y-m-d'), $TimeSlots[$i]);
                if ($CheckExistingTimeSlot == 0) {
                    $MaidTimeSlot = new MaidTimeSlot();
                    $MaidTimeSlot->maid_id = Auth::User()->id;
                    $MaidTimeSlot->date = Carbon::parse($request->date)->format('Y-m-d');
                    $MaidTimeSlot->time_slot_id = $TimeSlots[$i];
                    $MaidTimeSlot->status = $request->status;
                    $SaveTimeSlot[] = $MaidTimeSlot->save();
                    $this->StoreBookingRequest($TimeSlots[$i], $MaidTimeSlot->id);
                }
            }

            if (count($SaveTimeSlot) > 0) {
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

    private function StoreBookingRequest($timeslot, $maidTimeSlot)
    {
        $Booking = Booking::where('time_slot_id', $timeslot)->get();
        if (isset($Booking)) 
        {
            foreach ($Booking as $SingleBooking) 
            {
                if($SingleBooking->AlreadyRequests($SingleBooking->id)==0)
                {
                        try {
                            // Send Booking Requests to maid according to matched time slots
                            $BookingRequests = new BookingRequest();
                            $BookingRequests->booking_id = $SingleBooking->id;
                            $BookingRequests->maid_id = Auth::User()->id;
                            $BookingRequests->maid_time_slot_id = $maidTimeSlot;
                            $BookingRequests->status = 1;
                            $BookingRequests->created_at = Carbon::now();
                            $BookingRequests->updated_at = Carbon::now();
                            $BookingRequests->save();

                            $MaidDetails = Auth::User();
                            // sent to maid
                            dispatch(new SendBookingRequestEmailJob($MaidDetails, $BookingRequests, 'sent_to_maid'));
                        } catch (ModelNotFoundException $exception) {

                            session()->flash('error', 'Time slot Data is not saved for booking request.');
                            return redirect()->route('schedules.index');
                        }
                }
            }
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
            $BookingRequests = BookingRequest::with('maid_time_slot.timeSlot')->where('maid_time_slot_id', $id)->get();

            return view('backend.schedule.booking_requests', ['booking_requests' => $BookingRequests]);
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
            $TimeSlots = TimeSlot::where('status', 1)->pluck('slot', 'id');
        } catch (ModelNotFoundException $exception) {
            session()->flash('error', 'No data found of this id');
            return redirect()->route('schedules.index');
        }
        return view('backend.schedule.update')->with(['maid_time_slot' => $MaidTimeSlot, 'status_dropdown' => $this->status_dropdown, 'slots' => $TimeSlots]);
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

            $CheckExistingTimeSlot = MaidTimeSlot::CheckExistingTimeSlot(Carbon::parse($request->date)->format('Y-m-d'), $request->time_slot_id, $id);

            if ($CheckExistingTimeSlot == 0) {
                $MaidTimeSlot = MaidTimeSlot::findOrFail($id);
                $MaidTimeSlot->date = Carbon::parse($request->date)->format('Y-m-d');
                $MaidTimeSlot->time_slot_id = $request->time_slot_id;
                $MaidTimeSlot->status = $request->status;
                $SaveTimeSlot = $MaidTimeSlot->save();

                if ($SaveTimeSlot) {
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

            $rules = [
                'request_id' => 'required',
                'status' => 'required'
            ];
            $validator = Validator::make(request()->all(), $rules);

            // Validate the input and return correct response
            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => $validator->errors()]);
            } else {

                if (request()->status == 2) {
                    $rules = [
                        'arrive_date' => 'required',
                        'arrive_time' => 'required',
                        'special_instructions' => 'required',
                    ];

                    $validator = Validator::make(request()->all(), $rules);

                    // Validate the input and return correct response
                    if ($validator->fails()) {
                        return response()->json(['status' => false, 'message' => $validator->errors()]);
                    }
                }
                $BookingRequests = BookingRequest::where(['id' => request()->input('request_id'), 'maid_id' => Auth::User()->id])->first();

                $CheckBookingStatus = BookingRequest::where(['booking_id' => $BookingRequests->booking_id, 'maid_id' => Auth::User()->id])->where('status', 2)->count();

                if ($CheckBookingStatus == 0) {
                    $GetTimeSlot = isset($BookingRequests->booking_details->time_slot->slot) ? $BookingRequests->booking_details->time_slot->slot : [];

                    $TimeSlot = explode('-', $GetTimeSlot);

                    if (isset($TimeSlot[0])) {
                        $Time = $TimeSlot[0];
                    } else {
                        $Time = '';
                    }

                    if (request()->status == 2) {

                        $Check = $this->compareTime($Time, request()->input('arrive_time'), Carbon::parse($BookingRequests->booking_details->booking_date)->format('m/d/Y'));

                        if ($Check) {

                            $BookingRequests->arrive_date = request()->input('arrive_date');
                            $BookingRequests->arrive_time = request()->input('arrive_time');
                            $BookingRequests->special_instructions = request()->input('special_instructions');
                            $BookingRequests->status = request()->input('status');

                            if ($BookingRequests->save()) {
                                if (request()->input('status') == 2) {
                                    // Send Alert to user
                                    dispatch(new SendBookingRequestEmailJob($BookingRequests->booking_details->customer, $BookingRequests, 'sent_to_customer'));

                                    // update other requests who have sent to another maids
                                    $UpdateOtherBookingRequests = BookingRequest::where('id', '<>', $BookingRequests->id)->where(['booking_id' => $BookingRequests->booking_id, 'status' => 1])->get();

                                    foreach ($UpdateOtherBookingRequests as $SingleBookingRequest) {
                                        $SingleBookingRequest->status = 8; // accepted by other.
                                        $SingleBookingRequest->save();
                                    }
                                }

                                return response()->json(['status' => true, 'message' => 'Booking request has been ' . request()->input('type')]);
                            } else {

                                return response()->json(['status' => false, 'message' => 'Sorry! Booking request has not been updated']);
                            }
                        } else {
                            return response()->json(['status' => false, 'message' => 'Sorry! Time should be less than as per selected time slot']);
                        }
                    } else {

                        $BookingRequests->status = request()->input('status');
                        if ($BookingRequests->save()) {
                            return response()->json(['status' => true, 'message' => 'Booking request has been ' . request()->input('type')]);
                        }
                    }
                } else {

                    return response()->json(['status' => false, 'message' => 'Sorry! This booking id request has already accepted']);
                }
            }
        }
    }

    private function compareTime($chooseTime, $selectTime, $date)
    {
        $chooseTime = Carbon::createFromTimeString($date . ' ' . $chooseTime)->timestamp;
        $CurrentTime = Carbon::createFromTimeString($date . ' ' . $selectTime)->timestamp;

        $Date = Carbon::parse($date)->timestamp;
        $CDate = Carbon::now()->timestamp;

        if ($chooseTime > $CurrentTime) {
            return true;
        } else {
            return false;
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
