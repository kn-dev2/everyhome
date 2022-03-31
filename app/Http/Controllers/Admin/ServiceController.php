<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;  
use App\Http\Requests\Services\ServiceCreateRequest;
use App\Http\Requests\Services\ServiceEditRequest;
use App\Repositories\ServiceRepository;
use App\Models\Service;

class ServiceController extends Controller
{
    protected $serciceRepository;
    public $status_dropdown;

    public function __construct(ServiceRepository $serciceRepository)
    {
        $this->status_dropdown = config('global.status_dropdown');
        $this->serciceRepository = $serciceRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = $this->serciceRepository->listAll();
        return view('backend.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.services.create')->with(['status_dropdown'=>$this->status_dropdown]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceCreateRequest $request)
    {
        //
        try {

            $Service = new Service();
            $Service->title = $request->title;
            $Service->status = $request->status;
            $SaveService = $Service->save();
            if($SaveService)
            {
                    session()->flash('success', 'Service Data is saved.');
                    return redirect()->route('services.index');
            } else {
                session()->flash('error', 'Service Data is not saved.');
                return redirect()->route('backend.services.index');
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
             $service = $this->serciceRepository->serviceDetails($id);
        } catch (ModelNotFoundException $exception) {
            session()->flash('error', 'No data found of this id');
            return redirect()->route('services.index');
        }
        return view('backend.services.update')->with(['service'=>$service,'status_dropdown'=>$this->status_dropdown]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceEditRequest $request, $id)
    {
        try {

            $Service = Service::findOrFail($id);
            $Service->title = $request->title;
            $Service->status = $request->status;

            $SaveService = $Service->save();

            if ($SaveService) 
            {
                session()->flash('success', 'Service details has been updated.');
                return redirect()->route('services.index');
  
            } else {
                session()->flash('error', 'Service Data is not updated.');
                return redirect()->route('services.index');
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
