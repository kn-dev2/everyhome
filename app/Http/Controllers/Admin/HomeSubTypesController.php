<?php

namespace App\Http\Controllers\Admin;

use App\Models\HomeSubType;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException; 
use Illuminate\Http\Request;
use App\Http\Requests\HomeSubTypes\HomeSubTypesCreateRequest;
use App\Http\Requests\HomeSubTypes\HomeSubTypesEditRequest;
use App\Repositories\HomeSubTypesRepository;
use App\Repositories\HomeTypesRepository;

class HomeSubTypesController extends Controller
{
    protected $homesubtypesRepository;
    protected $hometypesRepository;
    public $status_dropdown;

    public function  __construct(HomeSubTypesRepository $homesubtypesRepository,HomeTypesRepository $hometypesRepository)
    {
        $this->homesubtypesRepository = $homesubtypesRepository;
        $this->hometypesRepository = $hometypesRepository;
        $this->status_dropdown = config('global.status_dropdown');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $home_sub_types = $this->homesubtypesRepository->listAll();
        return view('backend.home_sub_types.index', compact('home_sub_types'));
    }

    public function ajaxGetHomeSubTypeData()
    {
        if (request()->ajax()) {

            $home_sub_type_id        = request()->input('home_sub_type');
            $HomeSubTypeDetails      = $this->homesubtypesRepository->Details($home_sub_type_id);
            $Single_home_type         = $this->hometypesRepository->first($HomeSubTypeDetails->home_type_id);
            //sum of time 
            if(isset($HomeSubTypeDetails->min)) {
                $total_min = $Single_home_type->min + $HomeSubTypeDetails->min;
                $Hours   = floor($total_min/60);
                $Minutes = ($total_min -   floor($total_min / 60) * 60); 
            } else {
                $total_min = $Single_home_type->min;
                $Hours   = floor($total_min/60);
                $Minutes = ($total_min -   floor($total_min / 60) * 60); 
            }
            return response()->json(['home_sub_type_details'=>$HomeSubTypeDetails,'Minutes' => $Minutes,'Hours' => $Hours]);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $home_types = $this->homesubtypesRepository->getHometype();
        return view('backend.home_sub_types.create')->with(['status_dropdown'=>$this->status_dropdown,'home_types' => $home_types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HomeSubTypesCreateRequest $request)
    {
        //
        try {
            $HomeSubType = new HomeSubType();
            $HomeSubType->home_type_id = $request->home_type_id;
            $HomeSubType->title        = $request->title;
            $HomeSubType->price        = $request->price;
            $HomeSubType->status       = $request->status;
            $HomeSubType->hour         = $request->hour;
            $HomeSubType->min          = $request->min;
            $SaveHomeSubTypes = $HomeSubType->save();

            if($SaveHomeSubTypes)
            {
                    session()->flash('success', 'Home sub type Data is saved.');
                    return redirect()->route('homesubtypes.index');
            } else {
                session()->flash('error', 'Home sub type data is not saved.');
                return redirect()->route('backend.home_sub_types.index');
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
            $home_sub_type = $this->homesubtypesRepository->Details($id);
            $home_types = $this->homesubtypesRepository->getHometype();
        } catch (ModelNotFoundException $exception) {
           session()->flash('error', 'No data found of this id');
           return redirect()->route('homesubtypes.index');
        }
        return view('backend.home_sub_types.update')->with(['home_sub_type'=>$home_sub_type,'status_dropdown'=>$this->status_dropdown,'home_types'=>$home_types]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HomeSubTypesEditRequest $request, $id)
    {
        //
        try {
            $HomeSubType = HomeSubType::findOrFail($id);
            $HomeSubType->home_type_id = $request->home_type_id;
            $HomeSubType->title        = $request->title;
            $HomeSubType->price        = $request->price;
            $HomeSubType->status       = $request->status;       
            $HomeSubType->hour         = $request->hour;
            $HomeSubType->min          = $request->min;
            $SaveHomeType = $HomeSubType->save();

            if ($SaveHomeType) 
            {
                session()->flash('success', 'Home sub type details has been updated.');
                return redirect()->route('homesubtypes.index');
  
            } else {
                session()->flash('error', 'Home sub type Data is not updated.');
                return redirect()->route('homesubtypes.index');
            }
        } catch (\Illuminate\Database\QueryException $exception) {

            echo "ss"; die;
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
