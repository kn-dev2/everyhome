<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;  
use App\Http\Requests\HomeTypes\HomeTypesCreateRequest;
use App\Http\Requests\HomeTypes\HomeTypesEditRequest;
use App\Repositories\HomeTypesRepository;
use App\HomeType;

class HomeTypesController extends Controller
{
    protected $hometypesRepository;
    public $status_dropdown;

    public function __construct(HomeTypesRepository $hometypesRepository)
    {
        $this->status_dropdown = config('global.status_dropdown');
        $this->hometypesRepository = $hometypesRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $home_types = $this->hometypesRepository->listAll();
        return view('backend.home_types.index', compact('home_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.home_types.create')->with(['status_dropdown'=>$this->status_dropdown]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HomeTypesCreateRequest $request)
    {
        //
        try {

            $HomeType = new HomeType();
            $HomeType->title = $request->title;
            $HomeType->price = $request->price;
            $HomeType->status = $request->status;
            $SaveHomeTypes = $HomeType->save();

            if($SaveHomeTypes)
            {
                    session()->flash('success', 'Home type Data is saved.');
                    return redirect()->route('hometypes.index');
            } else {
                session()->flash('error', 'Customer Data is not saved.');
                return redirect()->route('backend.home_types.index');
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
             $home_type = $this->hometypesRepository->Details($id);
        } catch (ModelNotFoundException $exception) {
            session()->flash('error', 'No data found of this id');
            return redirect()->route('hometypes.index');
        }
        return view('backend.home_types.update')->with(['home_type'=>$home_type,'status_dropdown'=>$this->status_dropdown]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HomeTypesEditRequest $request, $id)
    {
        try {
            $HomeType = HomeType::findOrFail($id);
            $HomeType->title = $request->title;
            $HomeType->price = $request->price;
            $HomeType->status = $request->status;       

            $SaveHomeType = $HomeType->save();

            if ($SaveHomeType) 
            {
                session()->flash('success', 'Home type details has been updated.');
                return redirect()->route('hometypes.index');
  
            } else {
                session()->flash('error', 'Home type Data is not updated.');
                return redirect()->route('hometypes.index');
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
