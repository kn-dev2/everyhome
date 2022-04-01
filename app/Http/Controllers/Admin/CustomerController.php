<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;  
use App\Http\Requests\Customers\CustomerCreateRequest;
use App\Http\Requests\Customers\CustomerEditRequest;
use App\Repositories\CustomerRepository;
use App\Repositories\BookingRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\User as Customer;

class CustomerController extends Controller
{
    protected $customerRepository;
    protected $bookingRepository;
    public $roles;
    public $status_dropdown;

    public function __construct(CustomerRepository $customerRepository, BookingRepository $bookingRepository)
    {
        $this->roles = config('global.roles');
        $this->status_dropdown = config('global.status_dropdown');
        $this->customerRepository = $customerRepository;
        $this->bookingRepository = $bookingRepository;
        
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.customers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.customers.create')->with(['status_dropdown'=>$this->status_dropdown]);
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
            $Customer->role = $this->roles['Customer'];
            $Customer->name = $request->name;
            $Customer->email = $request->email;
            $Customer->status = $request->status;
            $Customer->password = Hash::make($request->password);
            $SaveCustomer = $Customer->save();

            if($SaveCustomer)
            {
                    session()->flash('success', 'Customer Data is saved.');
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
        try {
            $customer = $this->customerRepository->customerDetails($id,$this->roles);
            $booking_list = $this->bookingRepository->listAll($id);

       } catch (ModelNotFoundException $exception) {
           session()->flash('error', 'No data found of this id');
           return redirect()->route('customers.index');
       }
       return view('backend.customers.show')->with(['customer'=>$customer,'booking_list'=>$booking_list]);
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
             $customer = $this->customerRepository->customerDetails($id,$this->roles);
        } catch (ModelNotFoundException $exception) {
            session()->flash('error', 'No data found of this id');
            return redirect()->route('customers.index');
        }
        return view('backend.customers.update')->with(['customer'=>$customer,'status_dropdown'=>$this->status_dropdown]);
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

            $Customer = Customer::findOrFail($id);
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
                session()->flash('success', 'Customer details has been updated.');
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
