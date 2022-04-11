<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Repositories\ServiceRepository;
use App\Repositories\HomeTypesRepository;
use App\Repositories\ExtraServiceRepository;
use App\Repositories\HomeSubTypesRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;  
use Carbon\Carbon;
use App\Models\State;
use App\Models\DiscountCode;
use App\Models\Service;
use App\Models\HomeType;
use App\Models\HomeSubType;
use App\Models\ExtraService;
use App\Models\BookingItem;
use Faker\Core\Uuid;
use Validator;
use Response;
use Illuminate\Support\Str;
use Auth;

class HomeController extends Controller
{
    protected $serciceRepository;
    protected $extraserviceRepository;
    protected $hometypesRepository;
    protected $homesubtypesRepository;

    public function __construct(ServiceRepository $serciceRepository,HomeTypesRepository $hometypesRepository,HomeSubTypesRepository $homesubtypesRepository,ExtraServiceRepository $extraserviceRepository )
    {
        $this->serciceRepository        = $serciceRepository;
        $this->hometypesRepository      = $hometypesRepository;
        $this->homesubtypesRepository   = $homesubtypesRepository;
        $this->extraserviceRepository   = $extraserviceRepository;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $services = $this->serciceRepository->listAll(1);

        return view('frontend.home',['services'=>$services]);
    }

    /**
     * Show the book now page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function book_now()
    {
        $Service_id = isset($_GET['service_id']) ? $_GET['service_id'] : 1;

        $services                 = $this->serciceRepository->dropdown();
        $home_types               = $this->hometypesRepository->dropdown($Service_id);
        $extra_services           = $this->extraserviceRepository->get($Service_id);
        $Single_home_type         = $this->hometypesRepository->first($Service_id);

        if(isset($Single_home_type->id)) {

            $HomeSubTypeDropdown      = $this->homesubtypesRepository->DropDown($Single_home_type->id,'type');
            $HomeSubTypeId            = $HomeSubTypeDropdown->take(1)->keys()->first();

            if($HomeSubTypeId) {
                $HomeSubTypeDetails       = $this->homesubtypesRepository->Details($HomeSubTypeId);
                $SubTypePrice             = isset($HomeSubTypeDetails->price) ? $HomeSubTypeDetails->price : 0;
            } else {
                $HomeSubTypeDetails       = array();
                $SubTypePrice             = 0;
            }
            $TotalPrice               = $Single_home_type->price + $SubTypePrice;
            if(isset($HomeSubTypeDetails->min)) {
                $total_min = $Single_home_type->min + $HomeSubTypeDetails->min;
                $hours   = floor($total_min/60);
                $minutes = ($total_min -   floor($total_min / 60) * 60); 
                
            } else {
                $total_min = $Single_home_type->min;
                $hours   = floor($total_min/60);
                $minutes = ($total_min -   floor($total_min / 60) * 60); 
            }

        } else {

            $HomeSubTypeDropdown      = array();
            $HomeSubTypeId            = '';
            $HomeSubTypeDetails       = '';
            $SubTypePrice             = 0;
            $TotalPrice               = 0;
            $minutes = '';
            $hours   = '';
        }

        $States = State::where('status',1)->pluck('title','id');
        return view('frontend.book_now',['services'=>$services,'home_types'=>$home_types,'extra_services'=>$extra_services,'single_home_type'=>$Single_home_type,'states'=>$States,'service_id'=>$Service_id,'home_sub_type_dropdown'=>$HomeSubTypeDropdown,'home_sub_type_details'=>$HomeSubTypeDetails,'total_price'=>$TotalPrice,'hours' => $hours,'minutes' => $minutes]);
    }

    public function ajaxBookOrder(Request $request)
    {
        $rules = [
                    'service_id' => 'required', 
                    'home_type' => 'required',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required',
                    'phone' => 'required',
                    'address' => 'required',
                    'suite' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'zipcode' => 'required',
                    'date' => 'required',
                    'time_slot' => 'required',
                    'schedule_type'=> 'required'

                ];
        $validator = Validator::make($request->all(), $rules);

        // Validate the input and return correct response
        if ($validator->fails())
        {
            return Response::json(array(
                'status' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ), 200); // 400 being the HTTP code for an invalid request.

        } else {
            $time_slot = explode("#",$request->time_slot);
            //get_total detail 
            $total_detail = $this->get_total_detail($request->all());

            //insert booking detail in booking table
            $insertData['booking_date'] = Carbon::parse($request->date)->format('Y-m-d');
            $insertData['time_slot_id'] = $time_slot[1];
            $insertData['booking_id'] = (string) Str::uuid();
            $insertData['customer_id'] = Auth::user()->id;
            $insertData['services_id'] = $request->service_id;
            $insertData['home_type_id']   = $request->has('home_type') ? $request->home_type : '';
            $insertData['home_sub_type_id']   = $request->has('home_sub_type') ? $request->home_sub_type : '';
            $insertData['discout_coupan_id']  = $total_detail['disId'];
            $insertData['discout_price'] = $total_detail['disAmt'];
            $insertData['total_price'] = $total_detail['total_amount'];
            $insertData['schedule_type'] = $request->schedule_type;
            $insertData['status'] = 'success';
            //save into booking table
            $insertId = Booking::create($insertData)->id;
            unset($insertData);
            $data = $request->except(['_token']);
            // save extra service id with amount and qty 
            if(count($data['extra_service']) > 0) {
                foreach($data['extra_service'] as $key => $value) {
                    //get extra service price
                    $extra_service = ExtraService::find($value);
                    $qty=0;
                     if(isset($data['extra_service_qty'][$value])) {
                         $qty = $data['extra_service_qty'][$value];
                         if($qty > 0) {
                             $ex_price = $extra_service->price*$qty;
                         } else {
                             $ex_price = $extra_service->price;
                         }
                     } else {
                         $ex_price = $extra_service->price;
                     }
                     $insertData['booking_id'] = $insertId;
                     $insertData['extra_service_id'] = $extra_service->id;
                     $insertData['qty'] = $qty;
                     $insertData['base_price'] = $extra_service->price;
                     $insertData['price'] = $ex_price;
                     BookingItem::create($insertData);
                }
             }

             return Response::json(array(
                'status' => true,
                'message'  => 'New Booking has been created successfully',
            ), 200);
        }
    }

    public function ajaxCheckDiscountCode(Request $request)
    {
        $rules = [
                    'discount_code' => 'required', 
                ];
        $validator = Validator::make($request->all(), $rules);

        // Validate the input and return correct response
        if ($validator->fails())
        {
            return Response::json(array(
                'status' => false,
                'errors' => $validator->messages()->all()

            ), 200); // 400 being the HTTP code for an invalid request.

        } else {
            try {
                $DiscountCode = DiscountCode::where('discount_code',$request->discount_code)->whereRaw('? between vaild_from and valid_till', [Carbon::now()->format('Y-m-d')])->firstOrFail();

            return Response::json(array(
                    'status' => true,
                    'message'  => 'Discount code has been applied Successfully.',
                    'data' => $DiscountCode

                ), 200);
            } catch (ModelNotFoundException $exception) {

                return Response::json(array(
                    'status' => false,
                    // 'errors' => $exception->getMessage()
                    'errors' => 'This discount code is not vaild'

                ), 200);

            }
        }
    }

    /**
     * Show the gift_card page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function gift_card()
    {
        return view('frontend.gift_card');
    }

    /**
     * Show the services page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function services()
    {
        return view('frontend.services');
    }

    /**
     * Show the hiring page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function hiring()
    {
        return view('frontend.hiring');
    }

    private function get_total_detail($data) {
        //get service price 
        $service_detail = Service::find($data['service_id']);
        //get home type 
        if(isset($data['home_type'])) {
            $home_type_detail = HomeType::find($data['home_type']);
            $home_type_price = $home_type_detail->price;
        } else {
            $home_type_price = 0;
        }
        
        //get home sub type 
        if(isset($data['home_sub_type'])) {
            $home_sub_type_detail = HomeSubType::find($data['home_sub_type']);
            $home_sub_type_price = $home_sub_type_detail->price;
        } else {
            $home_sub_type_price = 0;
        }

        //check extra service
        $extra_services_price = 0;
        if(count($data['extra_service']) > 0) {
           foreach($data['extra_service'] as $key => $value) {
               //get extra service price
               $extra_service = ExtraService::find($value);
                if(isset($data['extra_service_qty'][$value])) {
                    $qty = $data['extra_service_qty'][$value];
                    if($qty > 0) {
                        $ex_price = $extra_service->price*$qty;
                    } else {
                        $ex_price = $extra_service->price;
                    }
                } else {
                    $ex_price = $extra_service->price;
                }
                $extra_services_price = $extra_services_price+$ex_price;
           }
        }
        //discount coupan 
        $discount = 0;$disId='';
        if(isset($data['discount_code'])) {
            if($data['discount_code'] != '') {
                $discount_detail = DiscountCode::where('discount_code',$data['discount_code'])->first();
                if($discount_detail) {
                    $discount = $discount_detail->amount;
                    $disId = $discount_detail->id;
                }
            }
        }

        //get total amount
        $total_amount = round(($home_type_price + $home_sub_type_price + $extra_services_price) - $discount,2);
        $data1['total_amount'] = $total_amount;
        $data1['disAmt'] = $discount;
        $data1['disId'] = $disId;

        return $data1;
    }
}
