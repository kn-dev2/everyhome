<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ServiceRepository;
use App\Repositories\HomeTypesRepository;
use App\Repositories\ExtraServiceRepository;
use Illuminate\Support\Carbon;
use App\Models\State;
use Validator;
use Response;
class HomeController extends Controller
{
    protected $serciceRepository;
    protected $extraserviceRepository;
    protected $hometypesRepository;

    public function __construct(ServiceRepository $serciceRepository,HomeTypesRepository $hometypesRepository,ExtraServiceRepository $extraserviceRepository )
    {
        $this->serciceRepository        = $serciceRepository;
        $this->hometypesRepository      = $hometypesRepository;
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
        $Service_id = isset($_GET['service_id']) ? $_GET['service_id'] : null;

        $services = $this->serciceRepository->dropdown();
        $home_types = $this->hometypesRepository->dropdown($Service_id);
        $extra_services = $this->extraserviceRepository->get($Service_id);
        $Single_home_type = $this->hometypesRepository->first($Service_id);
        $States = State::where('status',1)->pluck('title','id');
        return view('frontend.book_now',['services'=>$services,'home_types'=>$home_types,'extra_services'=>$extra_services,'single_home_type'=>$Single_home_type,'states'=>$States,'service_id'=>$Service_id]);
    }

    public function book_order(Request $request)
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
                    'extra_service' => 'required|array',
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
                'errors' => $validator->messages()->all()

            ), 200); // 400 being the HTTP code for an invalid request.

        } else {

            return Response::json(array(
                'status' => true,
                'message' => 'Booking data is ready for submit'

            ), 200);
        }

        // print_r($request->all()); die;
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
}
