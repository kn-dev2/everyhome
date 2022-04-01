<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\BookingRepository;
use App\Repositories\CustomerRepository;

class BookingsController extends Controller
{
    protected $bookingRepository;
    public $roles;

    public function __construct(BookingRepository $bookingRepository, CustomerRepository $customerRepository)
    {
        $this->bookingRepository = $bookingRepository;
        $this->customerRepository = $customerRepository;
        $this->roles = config('global.roles');


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(isset($_GET['customer_id']) && $_GET['customer_id']!='')
        {
            $booking_list = $this->bookingRepository->listAll($_GET['customer_id']);
        } else {
            $booking_list = $this->bookingRepository->listAll(null);
        }
        $customers = $this->customerRepository->customerDropdown($this->roles);
        return view('backend.bookings.index', compact('booking_list','customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
