<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;  
use App\Http\Requests\Profile\ProfileEditRequest;
use Illuminate\Support\Facades\Hash;
use App\User as Profile;
use Auth;

class ProfileController extends Controller
{

    public function __construct()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        try {
            $profile = Profile::findOrFail(Auth::User()->id);
        } catch (ModelNotFoundException $exception) {
            // print_r($exception->getMessage()); die;
            session()->flash('error', 'No data found of this id');
            return redirect()->route('profile.index');
        }

        return view('backend.profile.update')->with(['profile'=>$profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileEditRequest $request)
    {
        try {

            $Profile = Profile::find(Auth::User()->id);
            $Profile->name = $request->name;

            if(isset($request->password) && $request->password!='')
            {
                $Profile->password = Hash::make($request->password);
            }           

            $SaveProfile = $Profile->save();

            if ($SaveProfile) 
            {
                session()->flash('success', 'Profile details has been updated.');
                return redirect()->route('profile');
  
            } else {
                session()->flash('error', 'Profile Data is not updated.');
                return redirect()->route('profile');
            }
        } catch (\Illuminate\Database\QueryException $exception) {

            return back()->withError($exception->errorInfo)->withInput();
        }
    }
}
