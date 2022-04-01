<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CustomerRepository;
use App\Repositories\BookingRepository;
use App\Repositories\MaidRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $customerRepository;
    protected $bookingRepository;
    protected $maidRepository;
    public $roles;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CustomerRepository $customerRepository, BookingRepository $bookingRepository, MaidRepository $maidRepository)
    {
        $this->roles = config('global.roles');
        $this->customerRepository = $customerRepository;
        $this->bookingRepository = $bookingRepository;
        $this->maidRepository = $maidRepository;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $Countcustomers = $this->customerRepository->countAll($this->roles);
        $Countmaids = $this->maidRepository->countAll($this->roles);
        $Countbookings = $this->bookingRepository->countAll();
        $Sumbookings = $this->bookingRepository->sumAll();
        $todaybookings = $this->bookingRepository->todayAll();

        return view('backend.dashboard.index',compact('Countcustomers','Countbookings','Countmaids','Sumbookings','todaybookings'));
    }

    public function logout(Request $request) {
        \Auth::logout();
        return redirect(route('admin.login'));
    }
}
