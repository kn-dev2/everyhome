<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.home');
    }

    /**
     * Show the book now page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function book_now()
    {
        return view('frontend.book_now');
    }

    /**
     * Show the gift_card page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function gift_card()
    {
        return view('frontend.gift_card');
    }

    /**
     * Show the services page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function services()
    {
        return view('frontend.services');
    }

    /**
     * Show the hiring page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function hiring()
    {
        return view('frontend.hiring');
    }
}
