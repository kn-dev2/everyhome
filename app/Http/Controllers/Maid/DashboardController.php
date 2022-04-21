<?php

namespace App\Http\Controllers\Maid;

use App\Http\Controllers\Controller;
use App\Models\BookingRequest;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DashboardController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->data['BookingRequests']        = BookingRequest::where('maid_id', Auth::User()->id)->count();
        $this->data['ConfirmBookingRequests'] = BookingRequest::where('maid_id', Auth::User()->id)->whereIn('status', [2, 4, 6, 7])->count();
        $TotalAmounts           = BookingRequest::where('maid_id', Auth::User()->id)->whereIn('status', [6, 7])->get();

        $SumofPayments          = 0;
        foreach ($TotalAmounts as $SingleBookingAmount) {
            $SumofPayments += $SingleBookingAmount->booking_details->total_price;
        }

        $this->data['SumofPayments'] = $SumofPayments;
        $this->data['booking_requests'] = BookingRequest::with('maid_time_slot.timeSlot')->where('maid_id', Auth::User()->id)->orderBy('created_at','desc')->get();
        return view('backend.dashboard.maid_dashboard', ['data' => $this->data]);
    }
}
