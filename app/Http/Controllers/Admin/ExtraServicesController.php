<?php

namespace App\Http\Controllers\Admin;

use App\Models\ExtraService;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException; 
use Illuminate\Http\Request;
use App\Http\Requests\ExtraServices\ExtraServicesCreateRequest;
use App\Http\Requests\ExtraServices\ExtraServicesEditRequest;
use App\Repositories\ExtraServiceRepository;
use App\Repositories\ServiceRepository;

class ExtraServicesController extends Controller
{
    protected $servicesRepository;
    protected $extraserviceRepository;
    public $status_dropdown;
    public $extra_service_type_dropdown;
    public $extra_service_img_path;

    public function  __construct(ServiceRepository $servicesRepository,ExtraServiceRepository $extraserviceRepository)
    {
        $this->servicesRepository = $servicesRepository;
        $this->extraserviceRepository = $extraserviceRepository;
        $this->extra_service_img_path = config('global.extra_service_img_path');
        $this->status_dropdown = config('global.status_dropdown');
        $this->extra_service_type_dropdown = config('global.extra_service_type_dropdown');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $extra_services = $this->extraserviceRepository->listAll();
        return view('backend.extra_services.index', compact('extra_services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = $this->servicesRepository->dropdown();
        return view('backend.extra_services.create')->with(['status_dropdown'=>$this->status_dropdown,'extra_service_type_dropdown'=>$this->extra_service_type_dropdown,'services' => $services]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExtraServicesCreateRequest $request)
    {
        //
        try {
            $ExtraService               = new ExtraService();
            $ExtraService->type         = $request->type;
            $ExtraService->service_id   = $request->service_id;
            $ExtraService->title        = $request->title;
            if(isset($request->icon))
            {
                $iconName = time().'.'.$request->icon->getClientOriginalExtension();
                $request->icon->move(public_path($this->extra_service_img_path), $iconName);
                $ExtraService->icon        = $iconName;
            }
            $ExtraService->price        = $request->price;
            $ExtraService->status       = $request->status;
            $SaveExtraService           = $ExtraService->save();

            if($SaveExtraService)
            {
                    session()->flash('success', 'Extra Service Data is saved.');
                    return redirect()->route('extra_services.index');
            } else {
                session()->flash('error', 'Extra Service data is not saved.');
                return redirect()->route('backend.extra_services.index');
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
        //
        try {
            $extra_service = $this->extraserviceRepository->Details($id);
            $services = $this->servicesRepository->dropdown();
        } catch (ModelNotFoundException $exception) {
           session()->flash('error', 'No data found of this id');
           return redirect()->route('extra_services.index');
        }
        return view('backend.extra_services.update')->with(['extra_service'=>$extra_service,'extra_service_type_dropdown'=>$this->extra_service_type_dropdown,'status_dropdown'=>$this->status_dropdown,'services'=>$services]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExtraServicesEditRequest $request, $id)
    {
        //
        try {
            $ExtraService = ExtraService::findOrFail($id);
            $ExtraService->type         = $request->type;
            $ExtraService->service_id   = $request->service_id;
            $ExtraService->title        = $request->title;
            if(isset($request->icon))
            {
                $iconName = time().'.'.$request->icon->getClientOriginalExtension();
                $request->icon->move(public_path($this->extra_service_img_path), $iconName);
                $ExtraService->icon        = $iconName;
            }
            $ExtraService->price        = $request->price;
            $ExtraService->status       = $request->status;     

            $SaveExtraService = $ExtraService->save();

            if ($SaveExtraService) 
            {
                session()->flash('success', 'Extra Service details has been updated.');
                return redirect()->route('extra_services.index');
  
            } else {
                session()->flash('error', 'Extra Service details is not updated.');
                return redirect()->route('extra_services.index');
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
