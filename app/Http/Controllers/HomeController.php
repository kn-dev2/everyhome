<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ServiceRepository;
use App\Repositories\HomeTypesRepository;
use App\Repositories\ExtraServiceRepository;

class HomeController extends Controller
{
    protected $serciceRepository;
    protected $extraserviceRepository;
    protected $hometypesRepository;

    public function __construct(ServiceRepository $serciceRepository,HomeTypesRepository $hometypesRepository,ExtraServiceRepository $extraserviceRepository )
    {
        $this->serciceRepository        = $serciceRepository;
        $this->hometypesRepository      = $hometypesRepository;
        $this->extraserviceRepository   = $extraserviceRepository;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $services = $this->serciceRepository->listAll(1);

        return view('frontend.home',['services'=>$services]);
    }

    /**
     * Show the book now page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function book_now()
    {
        $services = $this->serciceRepository->dropdown();
        $home_types = $this->hometypesRepository->dropdown();
        $extra_services = $this->extraserviceRepository->get();

        return view('frontend.book_now',['services'=>$services,'home_types'=>$home_types,'extra_services'=>$extra_services]);
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
