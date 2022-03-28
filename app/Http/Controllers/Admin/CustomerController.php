<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerCreateRequest;
use App\Http\Requests\CustomerEditRequest;
use App\Repositories\CustomerRepository;
use Illuminate\Support\Facades\Hash;
use App\User as Customer;
use Auth;

class CustomerController extends Controller
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = $this->customerRepository->listAll();
        return view('backend.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.customers.create')->with([]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerCreateRequest $request)
    {
        //
        try {


            $Customer = new Customer();
            $Customer->role = 1;
            $Customer->name = $request->name;
            $Customer->email = $request->email;
            $Customer->status = $request->status;
            $Customer->password = Hash::make($request->password);

            $SaveCustomer = $Customer->save();

            if($SaveCustomer)
            {
                    session()->flash('error', 'Customer  Data is not saved.');
                    return redirect()->route('customers.index');
            } else {
                session()->flash('error', 'Customer Data is not saved.');
                return redirect()->route('backend.customers.index');
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
        $customer = Customer::where('id', $id)->where('role',1)->first();

        return view('backend.customers.update')->with(['customer'=>$customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerEditRequest $request, $id)
    {
        try {

            $Customer = Customer::find($id);
            $Customer->name = $request->name;
            $Customer->email = $request->email;
            $Customer->status = $request->status;

            if(isset($request->password) && $request->password!='')
            {
                $Customer->password = Hash::make($request->password);
            }           

            $SaveCustomer = $Customer->save();

            if ($SaveCustomer) 
            {
                session()->flash('error', 'Customer terminal address is not updated.');
                return redirect()->route('customers.index');
  
            } else {
                session()->flash('error', 'Customer Data is not updated.');
                return redirect()->route('customers.index');
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
