<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Profile\CustomerPasswordRequest;
use App\Http\Requests\Profile\CustomerProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User as Profile;
use App\Models\State;
use App\Models\Booking;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Profile = Profile::findOrFail(Auth::User()->id);
        $States   = State::where('status',1)->pluck('title','id');
        return view('frontend.profile.index',['profile'=>$Profile,'states'=>$States]);
    }

    public function password()
    {
        $Profile = Profile::findOrFail(Auth::User()->id);
        return view('frontend.profile.change_password',['profile'=>$Profile]);
    }

    public function updatePassword(CustomerPasswordRequest $request)
    {
        try {

            $Profile = Profile::find(Auth::User()->id);
            $Profile->password = Hash::make($request->password);
            $SaveProfile = $Profile->save();

            if ($SaveProfile) 
            {
                session()->flash('success', 'Password has been updated.');
                return redirect()->route('customer.password');
  
            } else {
                session()->flash('error', 'Password is not updated.');
                return redirect()->route('customer.password');
            }
        } catch (\Illuminate\Database\QueryException $exception) {

            return back()->withError($exception->errorInfo)->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerProfileRequest $request)
    {
        try {

            $Profile = Profile::find(Auth::User()->id);
            $Profile->name = $request->name;     
            $Profile->phone = $request->phone;     
            $Profile->suite = $request->suite;     
            $Profile->city = $request->city;     
            $Profile->state = $request->state;     
            $Profile->zipcode = $request->zipcode;     
            $Profile->address = $request->address;     
            $SaveProfile = $Profile->save();

            if ($SaveProfile) 
            {
                session()->flash('success', 'Profile details has been updated.');
                return redirect()->route('customer.profile');
  
            } else {
                session()->flash('error', 'Profile Data is not updated.');
                return redirect()->route('customer.profile');
            }
        } catch (\Illuminate\Database\QueryException $exception) {

            return back()->withError($exception->errorInfo)->withInput();
        }
    }

    public function allOrders()
    {
        $Bookings = Booking::where('customer_id',Auth::User()->id)->paginate(10);
        return view('frontend.profile.orders',['orders'=>$Bookings]);
    }

    public function singleOrder($order_id)
    {
        $BookingDetails = Booking::where(['customer_id'=>Auth::User()->id,'id'=>$order_id])->firstOrFail();
        return view('frontend.profile.single_order_details',['order_details'=>$BookingDetails]);
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
