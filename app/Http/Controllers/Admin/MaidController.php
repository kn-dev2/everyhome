<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;  
use App\Http\Requests\Maids\MaidCreateRequest;
use App\Http\Requests\Maids\MaidEditRequest;
use App\Repositories\MaidRepository;
use Illuminate\Support\Facades\Hash;
use App\User as Maid;
use Auth;

class MaidController extends Controller
{
    protected $maidRepository;
    public $roles;
    public $status_dropdown;

    public function __construct(MaidRepository $maidRepository)
    {
        $this->roles = config('global.roles');
        $this->status_dropdown = config('global.status_dropdown');
        $this->maidRepository = $maidRepository;
    }

 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maids = $this->maidRepository->listAll($this->roles);
        return view('backend.maids.index', compact('maids'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.maids.create')->with(['status_dropdown'=>$this->status_dropdown]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaidCreateRequest $request)
    {
        //
        try {

            $Maid = new Maid();
            $Maid->role = $this->roles['Maid'];
            $Maid->name = $request->name;
            $Maid->email = $request->email;
            $Maid->status = $request->status;
            $Maid->password = Hash::make($request->password);

            $SaveCustomer = $Maid->save();

            if($SaveCustomer)
            {
                    session()->flash('success', 'Maid  Data is saved.');
                    return redirect()->route('maids.index');
            } else {
                session()->flash('error', 'Maid Data is not saved.');
                return redirect()->route('backend.maids.index');
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
            $Maid = $this->maidRepository->maidDetails($id,$this->roles);
        } catch (ModelNotFoundException $exception) {
            session()->flash('error', 'No data found of this id');
            return redirect()->route('maids.index');
        }
        return view('backend.maids.update')->with(['maid'=>$Maid,'status_dropdown'=>$this->status_dropdown]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MaidEditRequest $request, $id)
    {
        try {

            $Maid = Maid::findOrFail($id);
            $Maid->name = $request->name;
            $Maid->email = $request->email;
            $Maid->status = $request->status;

            if(isset($request->password) && $request->password!='')
            {
                $Maid->password = Hash::make($request->password);
            }           

            $SaveMaid = $Maid->save();

            if ($SaveMaid) 
            {
                session()->flash('success', 'Maid details has been updated.');
                return redirect()->route('maids.index');
  
            } else {
                session()->flash('error', 'Maid Data is not updated.');
                return redirect()->route('maids.index');
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
