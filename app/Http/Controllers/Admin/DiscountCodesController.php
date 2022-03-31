<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;  
use App\Http\Requests\DiscountCodes\DiscountCodesCreateRequest;
use App\Http\Requests\DiscountCodes\DiscountCodesEditRequest;
use App\Repositories\DiscountCodesRepository;
use App\Models\DiscountCode;
use Carbon\Carbon;


class DiscountCodesController extends Controller
{
    protected $discountcodesRepository;
    public $type_dropdown;
    public function  __construct(DiscountCodesRepository $discountcodesRepository) {
        $this->discountcodesRepository = $discountcodesRepository;
        $this->type_dropdown = config('global.discount_type');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $discount_codes = $this->discountcodesRepository->listAll();
        return view('backend.discount_codes.index', compact('discount_codes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.discount_codes.create',['discountType' => $this->type_dropdown]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountCodesCreateRequest $request)
    {
        //
        try {
            $DiscountCode = new DiscountCode();
            $DiscountCode->discount_code = $request->discount_code;
            $DiscountCode->amount        = $request->amount;
            $DiscountCode->vaild_from    = Carbon::parse($request->vaild_from)->format('Y-m-d');
            $DiscountCode->valid_till    = Carbon::parse($request->valid_till)->format('Y-m-d');
            $DiscountCode->type          = $request->type;
            $DiscountCode->no_of_usage_customer    = $request->no_of_usage_customer;
            $DiscountCode->min_spend     = $request->min_spend;
            $SaveDiscountCode = $DiscountCode->save();
            if($SaveDiscountCode)
            {
                    session()->flash('success', 'Discount code Data is saved.');
                    return redirect()->route('discount_codes.index');
            } else {
                session()->flash('error', 'Discount code data is not saved.');
                return redirect()->route('backend.home_sub_types.index');
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            echo"<pre>";
            print_r($exception->errorInfo); die;
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
            $discount_code = $this->discountcodesRepository->Details($id);
        } catch (ModelNotFoundException $exception) {
           session()->flash('error', 'No data found of this id');
           return redirect()->route('homesubtypes.index');
        }
        return view('backend.discount_codes.update')->with(['discount_code'=>$discount_code,'discountType' => $this->type_dropdown]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DiscountCodesEditRequest $request, $id)
    {
        //
        try {
            $DiscountCode = DiscountCode::findOrFail($id);
            $DiscountCode->discount_code = $request->discount_code;
            $DiscountCode->amount        = $request->amount;
            $DiscountCode->vaild_from    = Carbon::parse($request->vaild_from)->format('Y-m-d');
            $DiscountCode->valid_till    = Carbon::parse($request->valid_till)->format('Y-m-d');
            $DiscountCode->type          = $request->type;
            $DiscountCode->no_of_usage_customer    = $request->no_of_usage_customer;
            $DiscountCode->min_spend     = $request->min_spend;

            $SaveHomeType = $DiscountCode->save();

            if ($SaveHomeType) 
            {
                session()->flash('success', 'Discount code details has been updated.');
                return redirect()->route('discount_codes.index');
  
            } else {
                session()->flash('error', 'Home sub type Data is not updated.');
                return redirect()->route('discount_codes.index');
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
