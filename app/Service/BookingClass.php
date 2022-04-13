<?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace App\Service;

use App\Repositories\BookingRepository;
use App\Models\Booking;
use Carbon\Carbon;

class BookingClass implements BookingRepository
{
    // All list
    public function listAll($cid=null)
    {
        if(isset($_GET['booking_id']) && $_GET['booking_id']!='')
        {
            if($cid == null) {
                return Booking::with('service')->with('home_type')->with('home_sub_type')->with('customer')->with('items')->where(['booking_id'=>$_GET['booking_id']])->paginate(10);
            } else {
                return Booking::with('service')->with('home_type')->with('home_sub_type')->with('customer')->with('items')->where(['customer_id'=>$cid,'booking_id'=>$_GET['booking_id']])->paginate(10);
            }
        } else if(isset($_GET['start_date']) && isset($_GET['end_date']) && $_GET['start_date']!='' && $_GET['end_date']!='') {
            if($cid == null) {
                return Booking::with('service')->with('home_type')->with('home_sub_type')->with('customer')->with('items')->whereBetween('date',[Carbon::parse($_GET['start_date'])->format('Y-m-d'),Carbon::parse($_GET['end_date'])->format('Y-m-d')])->paginate(10);
            } else {
                return Booking::with('service')->with('home_type')->with('home_sub_type')->with('customer')->with('items')->where(['customer_id'=>$cid])->whereBetween('date',[Carbon::parse($_GET['start_date'])->format('Y-m-d'),Carbon::parse($_GET['end_date'])->format('Y-m-d')])->paginate(10);
            }
        } else if(isset($_GET['start_date']) && isset($_GET['end_date']) && isset($_GET['booking_id']) && $_GET['start_date']!='' && $_GET['end_date']!='' && $_GET['booking_id']!='') {
            if($cid == null) {
                return Booking::with('service')->with('home_type')->with('home_sub_type')->with('customer')->with('items')->where(['booking_id'=>$_GET['booking_id']])->whereBetween('date',[Carbon::parse($_GET['start_date'])->format('Y-m-d'),Carbon::parse($_GET['end_date'])->format('Y-m-d')])->paginate(10);
            } else {
                return Booking::with('service')->with('home_type')->with('home_sub_type')->with('customer')->with('items')->where(['customer_id'=>$cid,'booking_id'=>$_GET['booking_id']])->whereBetween('date',[Carbon::parse($_GET['start_date'])->format('Y-m-d'),Carbon::parse($_GET['end_date'])->format('Y-m-d')])->paginate(10);
            }
        } else {
            if($cid == null) {
                return Booking::with('service')->with('home_type')->with('home_sub_type')->with('customer')->with('items')->paginate(10);
            } else {
                return Booking::with('service')->with('home_type')->with('home_sub_type')->with('customer')->with('items')->where(['customer_id'=>$cid])->paginate(10);
            }
        }

        // return Booking::with('service')->with('home_type')->with('home_sub_type')->with('items')->where('customer_id',$cid)->paginate(10);
    }

    // All today list
    public function todayAll()
    {
        return Booking::with('service')->with('home_type')->with('home_sub_type')->with('customer')->with('items')->where(['status'=>'success','booking_date'=>carbon::now()->format('Y-m-d')])->paginate(10);
       
    }
    

    // details
    public function Details($id,$cid)
    {
            return Booking::where(['customer_id'=>$cid,'id'=>$id])->firstOrFail();
    }

     // All bookings count
     public function countAll()
     {
         return Booking::where('status','success')->count();
     }

     // All bookings amount sum
     public function sumAll()
     {
         return Booking::where('status','success')->sum('total_price');
     }
}
